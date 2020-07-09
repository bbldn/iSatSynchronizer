<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\ProductDiscountSynchronizerContract;
use App\Service\Synchronizer\BackToFront\Implementation\ProductDiscountSynchronizer as ProductDiscountBaseSynchronizer;

class ProductDiscountSynchronizer extends ProductDiscountBaseSynchronizer implements ProductDiscountSynchronizerContract
{
    /**
     *
     */
    public function load(): void
    {
        parent::load();
    }

    /**
     *
     */
    public function clear(): void
    {
        $this->productDiscountFrontRepository->clear();
        $this->productDiscountFrontRepository->resetAutoIncrements();
    }

    /**
     * @param int $productId
     */
    public function createOrUpdateDiscountItems(int $productId): void
    {
        $customersGroupFront = $this->customerGroupRepository->findAll();
        foreach ($customersGroupFront as $customerGroupFront) {
            $this->createOrUpdateDiscountItem($customerGroupFront, $productId);
        }
    }

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