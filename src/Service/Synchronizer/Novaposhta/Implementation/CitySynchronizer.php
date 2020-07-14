<?php

namespace App\Service\Synchronizer\Novaposhta\Implementation;

use App\Entity\Front\Zone as ZoneFront;
use App\Helper\ExceptionFormatter;
use App\Helper\Filler;
use App\Repository\Front\CountryRepository as CountryFrontRepository;
use App\Repository\Front\ZoneRepository as ZoneFrontRepository;
use LisDev\Delivery\NovaPoshtaApi2;
use Psr\Log\LoggerInterface;

class CitySynchronizer extends NovaposhtaSynchronizer
{
    /** @var ZoneFrontRepository $zoneFrontRepository */
    protected $zoneFrontRepository;

    /** @var CountryFrontRepository $countryFrontRepository */
    protected $countryFrontRepository;

    /** @var NovaPoshtaApi2 $novaPoshtaApi2 */
    protected $novaPoshtaApi2;

    /** @var array $countryNamesById */
    protected $countryNamesById = [];

    /**
     * CitiesSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param ZoneFrontRepository $zoneFrontRepository
     * @param CountryFrontRepository $countryFrontRepository
     * @param NovaPoshtaApi2 $novaPoshtaApi2
     */
    public function __construct(
        LoggerInterface $logger,
        ZoneFrontRepository $zoneFrontRepository,
        CountryFrontRepository $countryFrontRepository,
        NovaPoshtaApi2 $novaPoshtaApi2
    )
    {
        parent::__construct($logger);
        $this->zoneFrontRepository = $zoneFrontRepository;
        $this->countryFrontRepository = $countryFrontRepository;
        $this->novaPoshtaApi2 = $novaPoshtaApi2;
    }

    /**
     * @param array $item
     * @param int $key
     */
    protected function createOrUpdateZone(array $item, int $key): void
    {
        foreach (['Ref', 'DescriptionRu', 'CityID', 'AreaDescriptionRu'] as $value) {
            if (false === key_exists($value, $item)) {
                $message = "Item with number: {$key} is not include `{$value}`";
                $this->logger->error(ExceptionFormatter::f($message));

                return;
            }
        }

        $item['Ref'] = Filler::trim($item['Ref']);
        $item['DescriptionRu'] = Filler::trim($item['DescriptionRu']);
        $item['CityID'] = Filler::trim($item['CityID']);
        $item['AreaDescriptionRu'] = Filler::trim($item['AreaDescriptionRu']);

        $countryName = "{$item['AreaDescriptionRu']} область";

        if (false === key_exists($countryName, $this->countryNamesById)) {
            $countryId = 0;
        } else {
            $countryId = $this->countryNamesById[$countryName];
        }

        $zoneFront = $this->zoneFrontRepository->findOneByCountryIdAndName($countryId, $item['DescriptionRu']);

        if (null === $zoneFront) {
            $zoneFront = new ZoneFront();
        }

        $zoneFront->setCountryId($countryId);
        $zoneFront->setName($item['DescriptionRu']);
        $zoneFront->setCode($item['CityID']);
        $zoneFront->setStatus(true);
        $zoneFront->setRef($item['Ref']);

        $this->zoneFrontRepository->persistAndFlush($zoneFront);
    }
}