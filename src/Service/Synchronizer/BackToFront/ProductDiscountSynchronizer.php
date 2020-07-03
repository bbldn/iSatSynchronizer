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
        parent::synchronizeAll();
    }

    /**
     * @param int $productBackId
     */
    public function synchronizeByProductBackId(int $productBackId): void
    {
        parent::synchronizeByProductBackId($productBackId);
    }

    /**
     * @param int $productId
     */
    public function createOrUpdateDiscountItems(int $productId): void
    {
        parent::createOrUpdateDiscountItems($productId);
    }
}