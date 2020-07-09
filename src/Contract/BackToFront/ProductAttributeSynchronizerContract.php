<?php

namespace App\Contract\BackToFront;

use App\Contract\CanClear;
use App\Contract\CanLoadInterface;
use App\Entity\Back\Product as ProductBack;

interface ProductAttributeSynchronizerContract extends CanLoadInterface, CanClear
{
    /**
     * @param ProductBack $productBack
     * @param int $productFrontId
     */
    public function synchronizeAttributes(ProductBack $productBack, int $productFrontId): void;
}