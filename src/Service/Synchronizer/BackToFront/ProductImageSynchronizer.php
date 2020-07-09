<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\ProductImageSynchronizerContract;
use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;
use App\Service\Synchronizer\BackToFront\Implementation\ProductImageSynchronizer as ProductImageSynchronizerBase;

class ProductImageSynchronizer extends ProductImageSynchronizerBase implements ProductImageSynchronizerContract
{
    /**
     *
     */
    public function load(): void
    {
        parent::load();
    }

    /**
     * @param ProductBack $productBack
     * @param ProductFront $productFront
     */
    public function synchronizeImage(ProductBack $productBack, ProductFront $productFront): void
    {
        parent::synchronizeImage($productBack, $productFront);
    }
}