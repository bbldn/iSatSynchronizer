<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\Discussions as ReviewBack;
use App\Entity\Review;
use App\Exception\ReviewBackNotFoundException;
use App\Other\Front\Store as StoreFront;
use App\Other\Store;
use App\Repository\Front\ReviewRepository as ReviewFrontRepository;
use App\Repository\Back\DiscussionsRepository as ReviewBackRepository;
use App\Entity\Front\Review as ReviewFront;
use App\Repository\ReviewRepository;
use App\Repository\ProductRepository;

class ReviewSynchronizer
{
    private $storeFront;
    private $reviewFrontRepository;
    private $reviewBackRepository;
    private $reviewRepository;
    private $productRepository;

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

    public function clear()
    {
        $this->reviewRepository->clear();
        $this->reviewFrontRepository->clear();

        $this->reviewRepository->resetAutoIncrements();
        $this->reviewFrontRepository->resetAutoIncrements();
    }

    /**
     *
     */
    public function synchronizeAll(): void
    {
        $reviewsBack = $this->reviewBackRepository->findAll();
        foreach ($reviewsBack as $reviewBack) {
            $this->synchronizeReviewBack($reviewBack);
        }
    }

    /**
     * @param int $id
     * @throws ReviewBackNotFoundException
     */
    public function synchronizeOne(int $id): void
    {
        $reviewBack = $this->reviewBackRepository->find($id);
        if (null === $reviewBack) {
            throw new ReviewBackNotFoundException();
        }

        $this->synchronizeReviewBack($reviewBack);
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

        $reviewFront->fill(
            $productFrontId,
            $this->storeFront->getDefaultCustomerId(),
            Store::encodingConvert($reviewBack->getAuthor()),
            Store::encodingConvert($reviewBack->getBody()),
            $reviewBack->getStars(),
            $reviewBack->getEnabled()
        );

        $this->reviewFrontRepository->saveAndFlush($reviewFront);

        return $reviewFront;
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
        $this->reviewRepository->saveAndFlush($review);
    }
}