<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Discussions as ReviewBack;
use App\Entity\Front\Review as ReviewFront;
use App\Entity\Review;
use App\Helper\Front\Store as StoreFront;
use App\Helper\Store;
use App\Repository\Back\DiscussionsRepository as ReviewBackRepository;
use App\Repository\Front\ReviewRepository as ReviewFrontRepository;
use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;
use DateTime;
use Exception;
use Psr\Log\LoggerInterface;

abstract class ReviewSynchronizer extends BackToFrontSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

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
     * @param LoggerInterface $logger
     * @param StoreFront $storeFront
     * @param ReviewFrontRepository $reviewFrontRepository
     * @param ReviewBackRepository $reviewBackRepository
     * @param ReviewRepository $reviewRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        LoggerInterface $logger,
        StoreFront $storeFront,
        ReviewFrontRepository $reviewFrontRepository,
        ReviewBackRepository $reviewBackRepository,
        ReviewRepository $reviewRepository,
        ProductRepository $productRepository
    )
    {
        $this->logger = $logger;
        $this->storeFront = $storeFront;
        $this->reviewFrontRepository = $reviewFrontRepository;
        $this->reviewBackRepository = $reviewBackRepository;
        $this->reviewRepository = $reviewRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @param ReviewBack $reviewBack
     * @throws Exception
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
     * @throws Exception
     */
    protected function updateReviewFrontFromReviewBack(ReviewFront $reviewFront, ReviewBack $reviewBack): ReviewFront
    {
        $product = $this->productRepository->findOneByBackId($reviewBack->getProductId());
        $productFrontId = null === $product ? 0 : $product->getFrontId();
        $date = $reviewBack->getAddTime() ?? new DateTime();

        $reviewFront->setProductId($productFrontId);
        $reviewFront->setCustomerId($this->storeFront->getDefaultCustomerId());
        $reviewFront->setAuthor(Store::encodingConvert($reviewBack->getAuthor()));
        $reviewFront->setText(Store::encodingConvert($reviewBack->getBody()));
        $reviewFront->setReply(trim(Store::encodingConvert($reviewBack->getAnswer())));
        $reviewFront->setRating($reviewBack->getStars());
        $reviewFront->setStatus($reviewBack->getEnabled());
        $reviewFront->setDateAdded($date);
        $reviewFront->setDateModified($date);

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