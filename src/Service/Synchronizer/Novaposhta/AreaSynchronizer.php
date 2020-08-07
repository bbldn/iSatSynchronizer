<?php

namespace App\Service\Synchronizer\Novaposhta;

use App\Contract\Novaposhta\AreaSynchronizerInterface;
use App\Exception\NovaposhtaDataException;
use App\Helper\ExceptionFormatter;
use App\Service\Synchronizer\Novaposhta\Implementation\AreaSynchronizer as AreaBaseSynchronizer;
use Throwable;

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
            $this->validateResponse($response);
        } catch (Throwable $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return;
        }


        foreach ($response['data'] as $key => $item) {
            try {
                $this->createOrUpdateCountry($item, $key);
            } catch (NovaposhtaDataException $e) {
                $this->logger->error(ExceptionFormatter::e($e));
            }
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