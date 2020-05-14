<?php

namespace App\Service\Synchronizer\FrontToBack\Implementation;

use App\Entity\Back\Discussions as ReviewBack;
use App\Entity\Review;
use App\Exception\ReviewFrontNotFoundException;
use App\Other\Filler;
use App\Other\Back\Store as StoreBack;
use App\Repository\Front\ReviewRepository as ReviewFrontRepository;
use App\Repository\Back\DiscussionsRepository as ReviewBackRepository;
use App\Entity\Front\Review as ReviewFront;
use App\Repository\ReviewRepository;
use App\Repository\ProductRepository;

class ReviewSynchronizer
{
    /** @var StoreBack $storeBack */
    protected $storeBack;

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
     * @param StoreBack $storeBack
     * @param ReviewFrontRepository $reviewFrontRepository
     * @param ReviewBackRepository $reviewBackRepository
     * @param ReviewRepository $reviewRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        StoreBack $storeBack,
        ReviewFrontRepository $reviewFrontRepository,
        ReviewBackRepository $reviewBackRepository,
        ReviewRepository $reviewRepository,
        ProductRepository $productRepository
    )
    {
        $this->storeBack = $storeBack;
        $this->reviewFrontRepository = $reviewFrontRepository;
        $this->reviewBackRepository = $reviewBackRepository;
        $this->reviewRepository = $reviewRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @param ReviewFront $reviewFront
     */
    protected function synchronizeReviewFront(ReviewFront $reviewFront): void
    {
        $review = $this->reviewRepository->findOneByFrontId($reviewFront->getReviewId());
        $reviewBack = $this->getReviewBackFromReview($review);
        $this->updateReviewBackFromReviewFront($reviewBack, $reviewFront);
        $this->createOrUpdateReview($review, $reviewBack->getDid(), $reviewFront->getReviewId());
    }

    /**
     * @param ReviewBack $reviewBack
     * @param ReviewFront $reviewFront
     * @return ReviewBack
     */
    protected function updateReviewBackFromReviewFront(ReviewBack $reviewBack, ReviewFront $reviewFront): ReviewBack
    {
        $product = $this->productRepository->findOneByBackId($reviewFront->getProductId());
        $productFrontId = 0;

        if (null !== $product) {
            $productFrontId = $product->getFrontId();
        }

        $reviewBack->fill(
            $productFrontId,
            $reviewFront->getAuthor(),
            $reviewFront->getText(),
            $reviewFront->getDateAdded(),
            $reviewFront->getAuthor(),
            Filler::securityString(null),
            $reviewFront->getStatus(),
            $reviewFront->getRating(),
            $this->storeBack->getDefaultSiteId()
        );

        $this->reviewBackRepository->persistAndFlush($reviewBack);

        return $reviewBack;
    }

    /**
     * @param Review|null $review
     * @return ReviewBack
     */
    protected function getReviewBackFromReview(?Review $review): ReviewBack
    {
        if (null === $review) {
            return new ReviewBack();
        }

        $reviewBack = $this->reviewBackRepository->find($review->getFrontId());

        if (null === $reviewBack) {
            return new ReviewBack();
        }

        return $reviewBack;
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