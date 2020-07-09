<?php

namespace App\Contract\BackToFront;

use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;

interface ProductImageSynchronizerContract
{
    /**
     *
     */
    public function load(): void;

    /**
     *
     */
    public function clearFolder(): void;

    /**
     * @param ProductBack $productBack
     * @param ProductFront $productFront
     */
    public function synchronizeImage(ProductBack $productBack, ProductFront $productFront): void;
}