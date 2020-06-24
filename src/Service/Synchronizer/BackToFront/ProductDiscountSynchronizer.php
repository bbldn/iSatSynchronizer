<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Service\Synchronizer\BackToFront\Implementation\ProductDiscountSynchronizer as ProductDiscountBaseSynchronizer;

class ProductDiscountSynchronizer extends ProductDiscountBaseSynchronizer
{
    /**
     *
     */
    public function synchronizeAll(): void
    {
        $productDiscountsBack = $this->productDiscountBackRepository->findAll();
        foreach ($productDiscountsBack as $productDiscountBack) {
            $this->synchronizeProductDiscount($productDiscountBack);
        }
    }

    /**
     * @param int $productBackId
     */
    public function synchronizeByProductBackId(int $productBackId): void
    {
        $productDiscountsBack = $this->productDiscountBackRepository->findByProductBackId($productBackId);
        $productDiscountBack = $this->getProductDiscountBack($productBackId);

        if (null !== $productDiscountBack) {
            $productDiscountsBack[] = $productDiscountBack;
        }

        foreach ($productDiscountsBack as $productDiscountBack) {
            $this->synchronizeProductDiscount($productDiscountBack);
        }
    }
}