<?php

namespace App\Service\Synchronizer\FrontToBack;

use App\Exception\OrderFrontNotFoundException;
use App\Helper\ExceptionFormatter;
use App\Service\Synchronizer\FrontToBack\Implementation\OrderSynchronizer as OrderBaseSynchronizer;

class OrderSynchronizer extends OrderBaseSynchronizer
{
    /**
     *
     */
    public function synchronizeAll(): void
    {
        $ordersFront = $this->orderFrontRepository->findAll();
        try {
            foreach ($ordersFront as $orderFront) {
                $this->synchronizeOrder($orderFront);
            }
        } catch (OrderFrontNotFoundException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));
        }
    }

    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void
    {
        $ordersFront = $this->orderFrontRepository->findByIds($ids);
        try {
            foreach ($ordersFront as $orderFront) {
                $this->synchronizeOrder($orderFront);
            }
        } catch (OrderFrontNotFoundException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));
        }
    }

    /**
     *
     */
    public function clear(): void
    {
        parent::clear();
    }
}