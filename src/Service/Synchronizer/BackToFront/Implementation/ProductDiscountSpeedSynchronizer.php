<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

class ProductDiscountSpeedSynchronizer extends ProductDiscountSynchronizer
{
    /**
     *
     */
    protected function synchronizeAll(): void
    {
        $discountPrices = $this->productDiscountBackRepository->getPricesAll();
        $productPrices = $this->productBackRepository->getPricesAll();
        $values = array_merge($discountPrices, $productPrices);
        $this->productDiscountFrontRepository->updatePriceByValues($values);
    }

    /**
     * @param string $ids
     */
    protected function synchronizeByIds(string $ids): void
    {
        $discountPrices = $this->productDiscountBackRepository->getPricesByIds($ids);
        $productPrices = $this->productBackRepository->getPricesByIds($ids);
        $values = array_merge($discountPrices, $productPrices);
        $this->productDiscountFrontRepository->updatePriceByValues($values);
    }
}