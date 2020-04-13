<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Service\Synchronizer\BackToFront\Implementation\ReviewSynchronizer as ReviewBackSynchronizer;

class ReviewSynchronizer extends ReviewBackSynchronizer
{
    /**
     * @param string $ids
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
    public function synchronizeAll(): void
    {
        $reviewsBack = $this->reviewBackRepository->findAll();
        foreach ($reviewsBack as $reviewBack) {
            $this->synchronizeReviewBack($reviewBack);
        }
    }

    /**
     *
     */
    public function reload(): void
    {
        $this->clear();
        $this->synchronizeAll();
    }
}