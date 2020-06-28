<?php

namespace App\Service\Synchronizer\Novaposhta;

use App\Helper\ExceptionFormatter;
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
     * @return bool
     */
    protected function validateResponse(array $response): bool
    {
        if (false === key_exists('success', $response)) {
            $message = 'Response does not include the key `success`';
            $this->logger->error(ExceptionFormatter::f($message));

            return false;
        }

        if ($response['success'] !== true) {
            $this->handleError($response);

            return false;
        }

        if (false === is_array($response['data'])) {
            $message = '`data` is not array';
            $this->logger->error(ExceptionFormatter::f($message));

            return false;
        }

        return true;
    }

    /**
     * @param array $response
     */
    private function handleError(array $response): void
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
}