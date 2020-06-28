<?php

namespace App\Service\Synchronizer\Novaposhta\Implementation;

use App\Entity\Front\Zone as ZoneFront;
use App\Helper\ExceptionFormatter;
use App\Helper\Filler;
use App\Service\Synchronizer\Novaposhta\NovaposhtaSynchronizer;
use App\Repository\Front\ZoneRepository as ZoneFrontRepository;
use App\Repository\Front\CountryRepository as CountryFrontRepository;
use Exception;
use LisDev\Delivery\NovaPoshtaApi2;
use Psr\Log\LoggerInterface;

class CitySynchronizer extends NovaposhtaSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

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
        $this->logger = $logger;
        $this->zoneFrontRepository = $zoneFrontRepository;
        $this->countryFrontRepository = $countryFrontRepository;
        $this->novaPoshtaApi2 = $novaPoshtaApi2;
    }

    /**
     *
     */
    protected function synchronizeAll(): void
    {
        try {
            $response = $this->novaPoshtaApi2->getCities();
        } catch (Exception $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return;
        }

        if (false === key_exists('success', $response)) {
            $message = 'Response does not include the key `success`';
            $this->logger->error(ExceptionFormatter::f($message));

            return;
        }

        if ($response['success'] !== true) {
            $this->handleError($response);

            return;
        }

        if (false === is_array($response['data'])) {
            $message = '`data` is not array';
            $this->logger->error(ExceptionFormatter::f($message));

            return;
        }

        $this->loadCountries();

        foreach ($response['data'] as $key => $item) {
            if (false === is_array($response['data'])) {
                $message = "Item with number: {$key} is not null";
                $this->logger->error(ExceptionFormatter::f($message));
                continue;
            }

            $this->createZone($item, $key);
        }
    }

    /**
     *
     */
    protected function loadCountries(): void
    {
        $countries = $this->countryFrontRepository->getCountries();
        foreach ($countries as $country) {
            $this->countryNamesById[$country['name']] = $country['countryId'];
        }
    }

    /**
     * @param array $item
     * @param int $key
     */
    protected function createZone(array $item, int $key): void
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
        $zoneFront->setCityRef($item['Ref']);

        $this->zoneFrontRepository->persistAndFlush($zoneFront);
    }

    /**
     * @param array $response
     */
    protected function handleError(array $response): void
    {
        if (false === key_exists('errors', $response)) {
            $message = 'Response does not include the key `errors`';
            $this->logger->error(ExceptionFormatter::f($message));

            return;
        }

        if (false === key_exists('errorCodes', $response)) {
            $message = 'Response does not include the key `errorCodes`';
            $this->logger->error(ExceptionFormatter::f($message));

            return;
        }

        $errors = $response['errors'];
        $errorCodes = $response['errorCodes'];

        if (count($errors) === count($errorCodes)) {
            $message = 'The number of errors is not equal to the number of error codes';
            $this->logger->error(ExceptionFormatter::f($message));

            return;
        }
    }

    /**
     *
     */
    protected function clear(): void
    {
        $this->zoneFrontRepository->removeAll();
        $this->zoneFrontRepository->setAutoIncrements(200000);
    }
}