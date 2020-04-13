<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Service\Synchronizer\BackToFront\Implementation\OrderSynchronizer as OrderBackSynchronizer;

class OrderSynchronizer extends OrderBackSynchronizer
{
    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids)
    {
        $ordersBack = $this->orderBackRepository->findByIds($ids);
        foreach ($ordersBack as $orderBack) {
            $this->synchronizeOrder($orderBack);
        }
    }

    /**
     *
     */
    public function synchronizeAll()
    {
        $ordersBack = $this->orderBackRepository->findWithoutIds($this->excludeCustomerIds);
        foreach ($ordersBack as $orderBack) {
            $this->synchronizeOrder($orderBack);
        }
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