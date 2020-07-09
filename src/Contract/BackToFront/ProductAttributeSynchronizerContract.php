<?php

namespace App\Contract\BackToFront;

use App\Entity\Back\Product as ProductBack;

interface ProductAttributeSynchronizerContract
{
    /**
     *
     */
    public function load(): void;

    /**
     * @param ProductBack $productBack
     * @param int $productFrontId
     */
    public function synchronizeAttributes(ProductBack $productBack, int $productFrontId): void;

    /**
     *
     */
    public function clear(): void;
}