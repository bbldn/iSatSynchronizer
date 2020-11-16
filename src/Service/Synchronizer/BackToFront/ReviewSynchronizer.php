<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\ReviewSynchronizerInterface;
use App\Service\Synchronizer\BackToFront\Implementation\ReviewSynchronizer as ReviewBackSynchronizer;
use Exception;

class ReviewSynchronizer extends ReviewBackSynchronizer implements ReviewSynchronizerInterface
{
    /**
     *
     */
    public function load(): void
    {
        parent::load();
    }

    /**
     * @throws Exception
     */
    public function synchronizeAll(): void
    {
        $reviewsBack = $this->reviewBackRepository->findAll();
        foreach ($reviewsBack as $reviewBack) {
            $this->synchronizeReviewBack($reviewBack);
        }
    }

    /**
     * @param string $ids
     * @throws Exception
     */
    public function synchronizeByIds(string $ids): void
    {
        $reviewsBack = $this->reviewBackRepository->findByIds($ids);
        foreach ($reviewsBack as $reviewBack) {
            $this->synchronizeReviewBack($reviewBack);
        }
    }

    /**
     *
     */
    public function clear(): void
    {
        $this->reviewRepository->clear();
        $this->reviewFrontRepository->clear();

        $this->reviewRepository->resetAutoIncrements();
        $this->reviewFrontRepository->resetAutoIncrements();
    }

    /**
     * @throws Exception
     */
    public function reload(): void
    {
        $this->clear();
        $this->synchronizeAll();
    }
}