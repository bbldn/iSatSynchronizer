<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\ProductAttributeSynchronizerContract;
use App\Entity\Back\Product as ProductBack;
use App\Service\Synchronizer\BackToFront\Implementation\ProductAttributeSynchronizer as ProductAttributeSynchronizerBase;

class ProductAttributeSynchronizer extends ProductAttributeSynchronizerBase implements ProductAttributeSynchronizerContract
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
     * @param int $productFrontId
     */
    public function synchronizeAttributes(ProductBack $productBack, int $productFrontId): void
    {
        $productAttributesBack = $this->attributeBackRepository->findAllByProductBackId($productBack->getProductId());
        foreach ($productAttributesBack as $productAttributeBack) {
            $this->synchronizeAttribute($productAttributeBack, $productFrontId);
        }
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