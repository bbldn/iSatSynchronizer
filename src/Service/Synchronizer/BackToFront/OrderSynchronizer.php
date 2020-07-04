<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Service\Synchronizer\BackToFront\Implementation\OrderSynchronizer as OrderBackSynchronizer;

class OrderSynchronizer extends OrderBackSynchronizer
{
    /**
     * @return OrderSynchronizer
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
        $ordersBack = $this->orderBackRepository->findWithoutIds($this->excludeCustomerIds);
        foreach ($ordersBack as $orderBack) {
            $this->synchronizeOrder($orderBack);
        }
    }

    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void
    {
        $ordersBack = $this->orderBackRepository->findByIds($ids);
        foreach ($ordersBack as $orderBack) {
            $this->synchronizeOrder($orderBack);
        }
    }

    /**
     *
     */
    public function clear(): void
    {
        parent::clear();
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