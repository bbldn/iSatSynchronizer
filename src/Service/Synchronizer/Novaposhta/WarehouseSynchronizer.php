<?php

namespace App\Service\Synchronizer\Novaposhta;

use App\Contract\Novaposhta\WarehouseSynchronizerInterface;
use App\Service\Synchronizer\Novaposhta\Implementation\WarehouseSynchronizer as WarehouseBaseSynchronizer;

class WarehouseSynchronizer extends WarehouseBaseSynchronizer implements WarehouseSynchronizerInterface
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
        $zones = $this->zoneFrontRepository->getZones();
        foreach ($zones as $key => $zone) {
            $response = $this->novaPoshtaApi2->getWarehouses($zone['ref']);
            if (false === is_array($response)) {
                continue;
            }
            $this->synchronizeWarehouses($response, $zone['zoneId']);
        }
    }

    /**
     *
     */
    public function clear(): void
    {
        $this->cityFrontRepository->removeAll();
        $this->cityFrontRepository->setAutoIncrements(100000);
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