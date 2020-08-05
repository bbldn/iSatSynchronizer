<?php

namespace App\Contract\BackToFront;

use App\Contract\CanClearInterface;
use App\Contract\CanLoadInterface;
use App\Entity\Back\Product as ProductBack;

interface ProductAttributeSynchronizerInterface extends CanLoadInterface, CanClearInterface
{
    /**
     * @param ProductBack $productBack
     * @param int $productFrontId
     */
    public function synchronizeAttributes(ProductBack $productBack, int $productFrontId): void;
}