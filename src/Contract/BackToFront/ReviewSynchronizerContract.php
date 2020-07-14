<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;
use App\Contract\CanReloadInterface;

interface ReviewSynchronizerContract extends CanLoadInterface, CanReloadInterface
{
    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void;
}