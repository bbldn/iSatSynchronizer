<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\Product as ProductBack;
use App\Service\Synchronizer\BackToFront\Implementation\ProductAttributeSynchronizer as ProductAttributeSynchronizerBase;

class ProductAttributeSynchronizer extends ProductAttributeSynchronizerBase
{
    /**
     * @return ProductAttributeSynchronizer
     */
    public function load(): self
    {
        return $this;
    }

    /**
     * @param ProductBack $productBack
     * @param int $productFrontId
     */
    public function synchronizeAttributes(ProductBack $productBack, int $productFrontId): void
    {
        parent::synchronizeAttributes($productBack, $productFrontId);
    }

    /**
     *
     */
    public function clear(): void
    {
        parent::clear();
    }
}