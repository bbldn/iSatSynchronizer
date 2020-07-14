<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;
use App\Contract\CanReloadInterface;

interface CategorySynchronizerContract extends CanLoadInterface, CanReloadInterface
{
    /**
     * @param string $ids
     * @param bool $synchronizeImage
     */
    public function synchronizeByIds(string $ids, bool $synchronizeImage = false): void;

    /**
     * @param string $name
     * @param bool $synchronizeImage
     */
    public function synchronizeByName(string $name, bool $synchronizeImage = false): void;
}