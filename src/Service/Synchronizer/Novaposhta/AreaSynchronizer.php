<?php

namespace App\Service\Synchronizer\Novaposhta;

use App\Contract\Novaposhta\AreaSynchronizerContract;
use App\Contract\Novaposhta\AreaSynchronizerInterface;
use App\Helper\ExceptionFormatter;
use App\Service\Synchronizer\Novaposhta\Implementation\AreaSynchronizer as AreaBaseSynchronizer;
use Exception;

class AreaSynchronizer extends AreaBaseSynchronizer implements AreaSynchronizerInterface
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
        try {
            $response = $this->novaPoshtaApi2->getAreas();
        } catch (Exception $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return;
        }

        if (false === $this->validateResponse($response)) {
            return;
        }


        foreach ($response['data'] as $key => $item) {
            $this->createOrUpdateCountry($item, $key);
        }
    }

    /**
     *
     */
    public function clear(): void
    {
        $this->countryFrontRepository->removeAll();
        $this->countryFrontRepository->setAutoIncrements(300001);
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