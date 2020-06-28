<?php

namespace App\Service\Synchronizer\Novaposhta\Implementation;

use App\Service\Synchronizer\Novaposhta\NovaposhtaSynchronizer;
use App\Repository\Front\CityRepository as CityFrontRepository;
use App\Repository\Front\ZoneRepository as ZoneFrontRepository;
use LisDev\Delivery\NovaPoshtaApi2;
use Psr\Log\LoggerInterface;

class WarehousesSynchronizer extends NovaposhtaSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

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
        $this->logger = $logger;
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
        foreach ($zones as $zone) {
            $item = $this->novaPoshtaApi2->getWarehouses($zone['name']);
        }
    }
}