<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\ProductAttributeSynchronizerContract;
use App\Entity\Back\Product as ProductBack;
use App\Service\Synchronizer\BackToFront\Implementation\ProductAttributeSynchronizer as ProductAttributeSynchronizerBase;

class ProductAttributeSynchronizer extends ProductAttributeSynchronizerBase implements ProductAttributeSynchronizerContract
{
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
        $this->productAttributeFrontRepository->clear();
        $this->productAttributeFrontRepository->resetAutoIncrements();
    }
}