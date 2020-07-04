<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

class ProductDiscountSpeedSynchronizer extends ProductDiscountSynchronizer
{
    /**
     *
     */
    protected function synchronizeAll(): void
    {
        $values = $this->productDiscountBackRepository->getPricesAll();
        $this->productDiscountFrontRepository->updatePriceByValues($values);
    }

    /**
     * @param string $ids
     */
    protected function synchronizeByIds(string $ids): void
    {
        $values = $this->productDiscountBackRepository->getPricesByIds($ids);
        $this->productDiscountFrontRepository->updatePriceByValues($values);
    }
}