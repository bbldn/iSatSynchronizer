<?php

namespace App\Service\Synchronizer\Novaposhta;

use App\Service\Synchronizer\Novaposhta\Implementation\WarehousesSynchronizer as WarehousesBaseSynchronizer;

class WarehousesSynchronizer extends WarehousesBaseSynchronizer
{
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
    public function reload(): void
    {
        $this->synchronizeAll();
    }
}