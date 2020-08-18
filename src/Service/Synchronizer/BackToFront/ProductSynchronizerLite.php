<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\Product as ProductBack;
use App\Service\Synchronizer\BackToFront\Implementation\ProductSynchronizerLite as ProductSynchronizerLiteBase;

class ProductSynchronizerLite extends ProductSynchronizerLiteBase
{
    /**
     * @param ProductBack $productBack
     */
    public function synchronizeProductLite(ProductBack $productBack): void
    {
        parent::synchronizeProductLite($productBack);
    }
}