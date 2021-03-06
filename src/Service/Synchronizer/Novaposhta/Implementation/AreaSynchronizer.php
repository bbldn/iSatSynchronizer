<?php

namespace App\Service\Synchronizer\Novaposhta\Implementation;

use App\Entity\Front\Country as CountryFront;
use App\Exception\NovaposhtaDataException;
use App\Repository\Front\CountryRepository as CountryFrontRepository;
use LisDev\Delivery\NovaPoshtaApi2;
use Psr\Log\LoggerInterface;

class AreaSynchronizer extends NovaposhtaSynchronizer
{
    /** @var CountryFrontRepository $countryFrontRepository */
    protected $countryFrontRepository;

    /** @var NovaPoshtaApi2 $novaPoshtaApi2 */
    protected $novaPoshtaApi2;

    /**
     * RegionSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param CountryFrontRepository $countryFrontRepository
     * @param NovaPoshtaApi2 $novaPoshtaApi2
     */
    public function __construct(
        LoggerInterface $logger,
        CountryFrontRepository $countryFrontRepository,
        NovaPoshtaApi2 $novaPoshtaApi2
    )
    {
        parent::__construct($logger);
        $this->countryFrontRepository = $countryFrontRepository;
        $this->novaPoshtaApi2 = $novaPoshtaApi2;
    }

    /**
     * @param array $item
     * @param int $key
     * @throws NovaposhtaDataException
     */
    protected function createOrUpdateCountry(array $item, int $key): void
    {
        if (false === key_exists('DescriptionRu', $item)) {
            throw new NovaposhtaDataException("Item with number: {$key} is not include `DescriptionRu`");
        }

        if ('АРК' === $item['DescriptionRu']) {
            return;
        }

        $countryName = "{$item['DescriptionRu']} область";

        $countryFront = $this->countryFrontRepository->findOneByName($countryName);
        if (null === $countryFront) {
            $countryFront = new CountryFront();
        }

        $countryFront->setName($countryName);
        $countryFront->setIsoCode2('UA');
        $countryFront->setIsoCode3('UKR');
        $countryFront->setAddressFormat('');
        $countryFront->setPostCodeRequired(false);
        $countryFront->setStatus(true);

        $this->countryFrontRepository->persistAndFlush($countryFront);
    }
}