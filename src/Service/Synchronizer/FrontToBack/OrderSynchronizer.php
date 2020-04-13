<?php

namespace App\Service\Synchronizer\FrontToBack;

use App\Service\Synchronizer\FrontToBack\Implementation\OrderSynchronizer as OrderBaseSynchronizer;

class OrderSynchronizer extends OrderBaseSynchronizer
{
    /**
     *
     */
    public function synchronizeAll(): void
    {
        $ordersFront = $this->orderFrontRepository->findAll();
        foreach ($ordersFront as $orderFront) {
            $this->synchronizeOrder($orderFront);
        }
    }

    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void
    {
        $ordersFront = $this->orderFrontRepository->findByIds($ids);
        foreach ($ordersFront as $orderFront) {
            $this->synchronizeOrder($orderFront);
        }
    }
}