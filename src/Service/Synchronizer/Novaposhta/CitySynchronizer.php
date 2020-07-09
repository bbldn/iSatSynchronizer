<?php

namespace App\Service\Synchronizer\Novaposhta;

use App\Service\Synchronizer\Novaposhta\Implementation\CitySynchronizer as CityBaseSynchronizer;

class CitySynchronizer extends CityBaseSynchronizer
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
        $this->clear();
        $this->synchronizeAll();
    }
}