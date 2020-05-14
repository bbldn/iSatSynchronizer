<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Discussions as ReviewBack;
use App\Entity\Front\Review as ReviewFront;
use App\Entity\Review;
use App\Other\Front\Store as StoreFront;
use App\Other\Store;
use App\Repository\Back\DiscussionsRepository as ReviewBackRepository;
use App\Repository\Front\ReviewRepository as ReviewFrontRepository;
use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;

class ReviewSynchronizer
{
    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var ReviewFrontRepository $reviewFrontRepository */
    protected $reviewFrontRepository;

    /** @var ReviewBackRepository $reviewBackRepository */
    protected $reviewBackRepository;

    /** @var ReviewRepository $reviewRepository */
    protected $reviewRepository;

    /** @var ProductRepository $productRepository */
    protected $productRepository;

    /**
     * ReviewSynchronizer constructor.
     * @param StoreFront $storeFront
     * @param ReviewFrontRepository $reviewFrontRepository
     * @param ReviewBackRepository $reviewBackRepository
     * @param ReviewRepository $reviewRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        StoreFront $storeFront,
        ReviewFrontRepository $reviewFrontRepository,
        ReviewBackRepository $reviewBackRepository,
        ReviewRepository $reviewRepository,
        ProductRepository $productRepository
    )
    {
        $this->storeFront = $storeFront;
        $this->reviewFrontRepository = $reviewFrontRepository;
        $this->reviewBackRepository = $reviewBackRepository;
        $this->reviewRepository = $reviewRepository;
        $this->productRepository = $productRepository;
    }

    /**
     *
     */
    protected function clear()
    {
        $this->reviewRepository->clear();
        $this->reviewFrontRepository->clear();

        $this->reviewRepository->resetAutoIncrements();
        $this->reviewFrontRepository->resetAutoIncrements();
    }

    /**
     * @param ReviewBack $reviewBack
     */
    protected function synchronizeReviewBack(ReviewBack $reviewBack): void
    {
        $review = $this->reviewRepository->findOneByBackId($reviewBack->getDid());
        $reviewFront = $this->getReviewFrontFromReview($review);
        $this->updateReviewFrontFromReviewBack($reviewFront, $reviewBack);
        $this->createOrUpdateReview($review, $reviewBack->getDid(), $reviewFront->getReviewId());
    }

    /**
     * @param Review|null $review
     * @return ReviewFront
     */
    protected function getReviewFrontFromReview(?Review $review): ReviewFront
    {
        if (null === $review) {
            return new ReviewFront();
        }

        $reviewFront = $this->reviewFrontRepository->find($review->getFrontId());

        if (null === $reviewFront) {
            return new ReviewFront();
        }

        return $reviewFront;
    }

    /**
     * @param ReviewFront $reviewFront
     * @param ReviewBack $reviewBack
     * @return ReviewFront
     */
    protected function updateReviewFrontFromReviewBack(ReviewFront $reviewFront, ReviewBack $reviewBack): ReviewFront
    {
        $product = $this->productRepository->findOneByBackId($reviewBack->getProductId());
        $productFrontId = 0;

        if (null !== $product) {
            $productFrontId = $product->getFrontId();
        }

        $reviewFront->setProductId($productFrontId);
        $reviewFront->setCustomerId($this->storeFront->getDefaultCustomerId());
        $reviewFront->setAuthor(Store::encodingConvert($reviewBack->getAuthor()));
        $reviewFront->setText(Store::encodingConvert($reviewBack->getBody()));
        $reviewFront->setRating($reviewBack->getStars());
        $reviewFront->setStatus($reviewBack->getEnabled());

        $this->reviewFrontRepository->persistAndFlush($reviewFront);

        return $reviewFront;
    }

    /**
     * @param Review|null $review
     * @param int $backId
     * @param int $frontId
     */
    protected function createOrUpdateReview(?Review $review, int $backId, int $frontId): void
    {
        if (null === $review) {
            $review = new Review();
        }

        $review->setBackId($backId);
        $review->setFrontId($frontId);

        $this->reviewRepository->persistAndFlush($review);
    }
}