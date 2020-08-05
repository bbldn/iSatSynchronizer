<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;
use App\Contract\CanReloadInterface;

interface ReviewSynchronizerInterface extends CanLoadInterface, CanReloadInterface
{
    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void;
}