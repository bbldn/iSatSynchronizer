<?php

namespace App\Service\Synchronizer\Novaposhta\Implementation;

use App\Entity\Front\City as CityFront;
use App\Helper\ExceptionFormatter;
use App\Helper\Filler;
use App\Repository\Front\CityRepository as CityFrontRepository;
use App\Repository\Front\ZoneRepository as ZoneFrontRepository;
use App\Service\Synchronizer\Novaposhta\NovaposhtaSynchronizer;
use LisDev\Delivery\NovaPoshtaApi2;
use Psr\Log\LoggerInterface;

class WarehouseSynchronizer extends NovaposhtaSynchronizer
{
    /** @var CityFrontRepository $cityFrontRepository */
    protected $cityFrontRepository;

    /** @var ZoneFrontRepository $zoneFrontRepository */
    protected $zoneFrontRepository;

    /** @var NovaPoshtaApi2 $novaPoshtaApi2 */
    protected $novaPoshtaApi2;

    /**
     * WarehousesSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param CityFrontRepository $cityFrontRepository
     * @param ZoneFrontRepository $zoneFrontRepository
     * @param NovaPoshtaApi2 $novaPoshtaApi2
     */
    public function __construct(
        LoggerInterface $logger,
        CityFrontRepository $cityFrontRepository,
        ZoneFrontRepository $zoneFrontRepository,
        NovaPoshtaApi2 $novaPoshtaApi2
    )
    {
        parent::__construct($logger);
        $this->cityFrontRepository = $cityFrontRepository;
        $this->zoneFrontRepository = $zoneFrontRepository;
        $this->novaPoshtaApi2 = $novaPoshtaApi2;
    }

    /**
     *
     */
    protected function synchronizeAll(): void
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
    protected function clear()
    {
        $this->cityFrontRepository->removeAll();
        $this->cityFrontRepository->setAutoIncrements(100000);
    }

    /**
     * @param array $response
     * @param int $zoneId
     */
    protected function synchronizeWarehouses(array $response, int $zoneId): void
    {
        if (false === $this->validateResponse($response)) {
            return;
        }

        foreach ($response['data'] as $key => $wirehouse) {
            $this->createOrUpdateCity($wirehouse, $zoneId, $key);
        }
    }

    /**
     * @param array $item
     * @param int $zoneId
     * @param int $key
     */
    protected function createOrUpdateCity(array $item, int $zoneId, int $key): void
    {
        foreach (['SiteKey', 'DescriptionRu'] as $value) {
            if (false === key_exists($value, $item)) {
                $message = "Item with number: {$key} is not include `{$value}`";
                $this->logger->error(ExceptionFormatter::f($message));

                return;
            }
        }

        $item['SiteKey'] = Filler::trim($item['SiteKey']);
        $item['DescriptionRu'] = Filler::trim($item['DescriptionRu']);

        $cityFront = $this->cityFrontRepository->findOneByCode($item['SiteKey']);
        if (null === $cityFront) {
            $cityFront = new CityFront();
        }

        $cityFront->setZoneId($zoneId);
        $cityFront->setName($item['DescriptionRu']);
        $cityFront->setStatus(true);
        $cityFront->setCode($item['SiteKey']);
        $cityFront->setSortOrder($key + 1);

        $this->cityFrontRepository->persistAndFlush($cityFront);
    }
}