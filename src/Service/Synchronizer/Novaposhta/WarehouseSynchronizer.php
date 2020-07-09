<?php

namespace App\Service\Synchronizer\Novaposhta;

use App\Service\Synchronizer\Novaposhta\Implementation\WarehouseSynchronizer as WarehouseBaseSynchronizer;

class WarehouseSynchronizer extends WarehouseBaseSynchronizer
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
        $this->synchronizeAll();
    }
}