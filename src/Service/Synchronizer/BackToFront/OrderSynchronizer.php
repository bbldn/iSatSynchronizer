<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\OrderSynchronizerContract;
use App\Event\BackToFront\OrderClearEvent;
use App\Service\Synchronizer\BackToFront\Implementation\OrderSynchronizer as OrderBackSynchronizer;

class OrderSynchronizer extends OrderBackSynchronizer implements OrderSynchronizerContract
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
        $this->orderProductFrontRepository->clear();
        $this->orderProductFrontRepository->resetAutoIncrements();

        $this->orderFrontRepository->clear();
        $this->orderFrontRepository->resetAutoIncrements();

        $this->orderRepository->clear();
        $this->orderRepository->resetAutoIncrements();

        $this->eventDispatcher->dispatch(new OrderClearEvent());
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