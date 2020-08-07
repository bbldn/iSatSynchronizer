<?php

namespace App\Service\Synchronizer\Novaposhta\Implementation;

use App\Exception\NovaposhtaDataException;
use App\Service\Synchronizer\Synchronizer;
use Psr\Log\LoggerInterface;

abstract class NovaposhtaSynchronizer extends Synchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /**
     * NovaposhtaSynchronizer constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param array $response
     * @throws NovaposhtaDataException
     */
    protected function validateResponse(array $response): void
    {
        if (false === key_exists('success', $response)) {
            throw new NovaposhtaDataException('Response does not include the key `success`');
        }

        if ($response['success'] !== true) {
            $this->handleError($response);
        }

        if (false === is_array($response['data'])) {
            throw new NovaposhtaDataException('`data` is not array');
        }
    }

    /**
     * @param array $response
     * @throws NovaposhtaDataException
     */
    private function handleError(array $response): void
    {
        if (false === key_exists('errors', $response)) {
            throw new NovaposhtaDataException('Response does not include the key `errors`');
        }

        if (false === key_exists('errorCodes', $response)) {
            throw new NovaposhtaDataException('Response does not include the key `errorCodes`');
        }

        if (count($response['errors']) !== count($response['errorCodes'])) {
            throw new NovaposhtaDataException('The number of errors is not equal to the number of error codes');
        }
    }
}