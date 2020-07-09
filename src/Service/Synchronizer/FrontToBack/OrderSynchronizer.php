<?php

namespace App\Service\Synchronizer\FrontToBack;

use App\Service\Synchronizer\FrontToBack\Implementation\OrderSynchronizer as OrderBaseSynchronizer;

class OrderSynchronizer extends OrderBaseSynchronizer
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
        parent::synchronizeAll();
    }

    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void
    {
        parent::synchronizeByIds($ids);
    }

    /**
     *
     */
    public function clear(): void
    {
        parent::clear();
    }
}