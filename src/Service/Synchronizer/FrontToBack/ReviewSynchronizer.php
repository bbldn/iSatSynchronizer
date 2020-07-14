<?php

namespace App\Service\Synchronizer\FrontToBack;

use App\Contract\FrontToBack\ReviewSynchronizerContract;
use App\Service\Synchronizer\FrontToBack\Implementation\ReviewSynchronizer as ReviewBaseSynchronizer;

class ReviewSynchronizer extends ReviewBaseSynchronizer implements ReviewSynchronizerContract
{
    /**
     *
     */
    public function load(): void
    {
        parent::load();
    }

    /**
     *
     */
    public function synchronizeAll(): void
    {
        $reviewsFront = $this->reviewFrontRepository->findAll();
        foreach ($reviewsFront as $reviewFront) {
            $this->synchronizeReviewFront($reviewFront);
        }
    }

    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void
    {
        $reviewsFront = $this->reviewFrontRepository->findByIds($ids);
        foreach ($reviewsFront as $reviewFront) {
            $this->synchronizeReviewFront($reviewFront);
        }
    }
}