<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Service\Synchronizer\BackToFront\Implementation\ProductDiscountSynchronizer as ProductDiscountSpeedSynchronizerBase;

abstract class ProductDiscountSpeedSynchronizer extends ProductDiscountSpeedSynchronizerBase
{
    /**
     *
     */
    public function load(): void
    {
    }

    /**
     *
     */
    public function synchronizeAll(): void
    {
        $discountPrices = $this->productDiscountBackRepository->getPricesAll();
        $productPrices = $this->productBackRepository->getPricesAll();
        $values = array_merge($discountPrices, $productPrices);
        $this->productDiscountFrontRepository->updatePriceByValues($values);
    }

    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void
    {
        $discountPrices = $this->productDiscountBackRepository->getPricesByIds($ids);
        $productPrices = $this->productBackRepository->getPricesByIds($ids);
        $values = array_merge($discountPrices, $productPrices);
        $this->productDiscountFrontRepository->updatePriceByValues($values);
    }
}