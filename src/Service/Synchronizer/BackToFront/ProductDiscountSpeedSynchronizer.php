<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\ProductDiscountSpeedSynchronizerContract;
use App\Service\Synchronizer\BackToFront\Implementation\ProductDiscountSpeedSynchronizer as ProductDiscountSpeedSynchronizerBase;

class ProductDiscountSpeedSynchronizer extends ProductDiscountSpeedSynchronizerBase implements ProductDiscountSpeedSynchronizerContract
{
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

    /**
     *
     */
    public function reload(): void
    {
        $this->clear();
        $this->synchronizeAll();
    }
}