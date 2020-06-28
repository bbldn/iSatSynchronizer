<?php

namespace App\Service\Synchronizer\Novaposhta\Implementation;

use App\Entity\Front\Country as CountryFront;
use App\Helper\ExceptionFormatter;
use App\Repository\Front\CountryRepository as CountryFrontRepository;
use App\Service\Synchronizer\Novaposhta\NovaposhtaSynchronizer;
use Exception;
use LisDev\Delivery\NovaPoshtaApi2;
use Psr\Log\LoggerInterface;

class AreaSynchronizer extends NovaposhtaSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

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
        $this->logger = $logger;
        $this->countryFrontRepository = $countryFrontRepository;
        $this->novaPoshtaApi2 = $novaPoshtaApi2;
    }

    /**
     *
     */
    protected function synchronizeAll(): void
    {
        try {
            $response = $this->novaPoshtaApi2->getAreas();
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


        foreach ($response['data'] as $key => $item) {
            if (false === is_array($response['data'])) {
                $message = "Item with number: {$key} is not null";
                $this->logger->error(ExceptionFormatter::f($message));
                continue;
            }

            $this->createCountry($item, $key);
        }
    }

    /**
     * @param array $item
     * @param int $key
     */
    protected function createCountry(array $item, int $key): void
    {
        if (false === key_exists('DescriptionRu', $item)) {
            $message = "Item with number: {$key} is not include `DescriptionRu`";
            $this->logger->error(ExceptionFormatter::f($message));

            return;
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

    /**
     * @param array $response
     */
    protected function handleError(array $response): void
    {
        if (false === key_exists('errors', $response)) {
            $this->logger->error(ExceptionFormatter::f('Response does not include the key `errors`'));

            return;
        }

        if (false === key_exists('errorCodes', $response)) {
            $this->logger->error(ExceptionFormatter::f('Response does not include the key `errorCodes`'));

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
        $this->countryFrontRepository->removeAll();
        $this->countryFrontRepository->setAutoIncrements(300001);
    }
}