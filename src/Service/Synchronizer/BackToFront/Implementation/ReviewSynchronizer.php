<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Discussions as ReviewBack;
use App\Entity\Front\Review as ReviewFront;
use App\Entity\Front\ReviewAnswer as ReviewAnswerFront;
use App\Entity\Review;
use App\Helper\Front\Store as StoreFront;
use App\Helper\Store;
use App\Repository\Back\DiscussionsRepository as ReviewBackRepository;
use App\Repository\Front\ReviewAnswerRepository as ReviewAnswerFrontRepository;
use App\Repository\Front\ReviewRepository as ReviewFrontRepository;
use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;
use DateTime;
use Psr\Log\LoggerInterface;

class ReviewSynchronizer extends BackToFrontSynchronizer
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

    /** @var ReviewAnswerFrontRepository $reviewAnswerFrontRepository */
    protected $reviewAnswerFrontRepository;

    /** @var bool $reviewAnswerTableExists */
    protected $reviewAnswerTableExists = false;

    /**
     * ReviewSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param StoreFront $storeFront
     * @param ReviewFrontRepository $reviewFrontRepository
     * @param ReviewBackRepository $reviewBackRepository
     * @param ReviewRepository $reviewRepository
     * @param ProductRepository $productRepository
     * @param ReviewAnswerFrontRepository $reviewAnswerFrontRepository
     */
    public function __construct(
        LoggerInterface $logger,
        StoreFront $storeFront,
        ReviewFrontRepository $reviewFrontRepository,
        ReviewBackRepository $reviewBackRepository,
        ReviewRepository $reviewRepository,
        ProductRepository $productRepository,
        ReviewAnswerFrontRepository $reviewAnswerFrontRepository
    )
    {
        $this->logger = $logger;
        $this->storeFront = $storeFront;
        $this->reviewFrontRepository = $reviewFrontRepository;
        $this->reviewBackRepository = $reviewBackRepository;
        $this->reviewRepository = $reviewRepository;
        $this->productRepository = $productRepository;
        $this->reviewAnswerFrontRepository = $reviewAnswerFrontRepository;
    }

    /**
     * @param ReviewBack $reviewBack
     */
    public function synchronizeReviewBack(ReviewBack $reviewBack): void
    {
        $review = $this->reviewRepository->findOneByBackId($reviewBack->getDid());
        $reviewFront = $this->getReviewFrontFromReview($review);
        $this->updateReviewFrontAndOtherFromReviewBack($reviewFront, $reviewBack);
        $this->createOrUpdateReview($review, $reviewBack->getDid(), $reviewFront->getReviewId());
    }

    /**
     * @param Review|null $review
     * @return ReviewFront
     */
    public function getReviewFrontFromReview(?Review $review): ReviewFront
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
    public function updateReviewFrontAndOtherFromReviewBack(
        ReviewFront $reviewFront,
        ReviewBack $reviewBack
    ): ReviewFront
    {
        $this->updateReviewFrontFromReviewBack($reviewFront, $reviewBack);
        $this->updateReviewAnswerFrontFromReviewBack($reviewFront, $reviewBack);

        return $reviewFront;
    }

    /**
     * @param ReviewFront $reviewFront
     * @param ReviewBack $reviewBack
     * @return ReviewFront
     */
    public function updateReviewFrontFromReviewBack(ReviewFront $reviewFront, ReviewBack $reviewBack): ReviewFront
    {
        $product = $this->productRepository->findOneByBackId($reviewBack->getProductId());
        if (null === $product) {
            $productFrontId = 0;
        } else {
            $productFrontId = $product->getFrontId();
        }

        $reviewFront->setProductId($productFrontId);
        $reviewFront->setCustomerId($this->storeFront->getDefaultCustomerId());
        $reviewFront->setAuthor(Store::encodingConvert($reviewBack->getAuthor()));
        $reviewFront->setText(Store::encodingConvert($reviewBack->getBody()));
        $reviewFront->setRating($reviewBack->getStars());
        $reviewFront->setStatus($reviewBack->getEnabled());

        if (null === $reviewBack->getAddTime()) {
            $date = new DateTime();
        } else {
            $date = $reviewBack->getAddTime();
        }

        $reviewFront->setDateAdded($date);
        $reviewFront->setDateModified($date);

        $this->reviewFrontRepository->persistAndFlush($reviewFront);

        return $reviewFront;
    }

    /**
     * @param ReviewFront $reviewFront
     * @param ReviewBack $reviewBack
     * @return ReviewAnswerFront|null
     */
    public function updateReviewAnswerFrontFromReviewBack(ReviewFront $reviewFront, ReviewBack $reviewBack): ?ReviewAnswerFront
    {
        $text = trim(Store::encodingConvert($reviewBack->getAnswer()));
        if (mb_strlen($text) === 0 || false === $this->reviewAnswerTableExists) {
            return null;
        }

        $reviewAnswerFront = $this->getReviewAnswerFrontByReviewFrontId($reviewFront->getReviewId());
        $reviewAnswerFront->setReviewId($reviewFront->getReviewId());
        $reviewAnswerFront->setText($text);

        $this->reviewAnswerFrontRepository->persistAndFlush($reviewAnswerFront);

        return $reviewAnswerFront;
    }

    /**
     * @param int $reviewFrontId
     * @return ReviewAnswerFront
     */
    public function getReviewAnswerFrontByReviewFrontId(int $reviewFrontId): ReviewAnswerFront
    {
        $reviewAnswerFront = $this->reviewAnswerFrontRepository->find($reviewFrontId);
        if (null !== $reviewAnswerFront) {
            return $reviewAnswerFront;
        }

        return new ReviewAnswerFront();
    }

    /**
     * @param Review|null $review
     * @param int $backId
     * @param int $frontId
     */
    public function createOrUpdateReview(?Review $review, int $backId, int $frontId): void
    {
        if (null === $review) {
            $review = new Review();
        }

        $review->setBackId($backId);
        $review->setFrontId($frontId);

        $this->reviewRepository->persistAndFlush($review);
    }
}