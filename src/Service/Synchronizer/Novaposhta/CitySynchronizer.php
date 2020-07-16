<?php

namespace App\Service\Synchronizer\Novaposhta;

use App\Contract\Novaposhta\CitySynchronizerContract;
use App\Helper\ExceptionFormatter;
use App\Service\Synchronizer\Novaposhta\Implementation\CitySynchronizer as CityBaseSynchronizer;
use Exception;

class CitySynchronizer extends CityBaseSynchronizer implements CitySynchronizerContract
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
            $response = $this->novaPoshtaApi2->getCities();
        } catch (Exception $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return;
        }

        if (false === $this->validateResponse($response)) {
            return;
        }

        $countries = $this->countryFrontRepository->getCountries();
        foreach ($countries as $country) {
            $this->countryNamesById[$country['name']] = $country['countryId'];
        }

        foreach ($response['data'] as $key => $item) {
            $this->createOrUpdateZone($item, $key);
        }
    }

    /**
     *
     */
    public function clear(): void
    {
        $this->zoneFrontRepository->removeAll();
        $this->zoneFrontRepository->setAutoIncrements(200000);
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