<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Service\Synchronizer\BackToFront\Implementation\ProductDiscountSpeedSynchronizer as ProductDiscountSpeedSynchronizerBase;

class ProductDiscountSpeedSynchronizer extends ProductDiscountSpeedSynchronizerBase
{
    /**
     * @return ProductDiscountSpeedSynchronizer
     */
    public function load(): self
    {
        parent::load();

        return $this;
    }

    /**
     *
     */
    public function synchronizeAll(): void
    {
        parent::synchronizeAll();
    }

    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void
    {
        parent::synchronizeByIds($ids);
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

    /**
     *
     */
    public function clear(): void
    {
        parent::clear();
    }
}