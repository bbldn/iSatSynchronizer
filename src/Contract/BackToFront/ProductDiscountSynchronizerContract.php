<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;
use App\Contract\CanReload;

interface ProductDiscountSynchronizerContract extends CanLoadInterface, CanReload
{
    /**
     * @param int $productBackId
     */
    public function synchronizeByProductBackId(int $productBackId): void;

    /**
     * @param int $productId
     */
    public function createOrUpdateDiscountItems(int $productId): void;
}