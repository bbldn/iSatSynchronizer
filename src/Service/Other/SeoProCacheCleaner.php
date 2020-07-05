<?php

namespace App\Service\Other;

use App\Helper\Front\Store as StoreFront;
use App\Service\Service;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class SeoProCacheCleaner extends Service
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var HttpClientInterface $httpClient */
    protected $httpClient;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var string $token */
    protected $token;

    /**
     * SeoProCacheCleaner constructor.
     * @param LoggerInterface $logger
     * @param HttpClientInterface $httpClient
     * @param StoreFront $storeFront
     * @param string $token
     */
    public function __construct(
        LoggerInterface $logger,
        HttpClientInterface $httpClient,
        StoreFront $storeFront,
        string $token
    )
    {
        $this->logger = $logger;
        $this->httpClient = $httpClient;
        $this->storeFront = $storeFront;
        $this->token = $token;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function clear(): void
    {
        $formData = new FormDataPart([
            'action' => 'remove-seourl-cache',
            'auth' => $this->token
        ]);

        $response = $this->httpClient->request('POST', $this->storeFront->getDefaultSitePath(), [
            'headers' => $formData->getPreparedHeaders()->toArray(),
            'body' => $formData->bodyToIterable(),
        ]);

        $this->validateResponse($response);
    }

    /**
     * @param ResponseInterface $response
     */
    protected function validateResponse(ResponseInterface $response)
    {
        try {
            $statusCode = $response->getStatusCode();
        } catch (TransportExceptionInterface $e) {
            throw new UploadException("Error getting status code: {$e->getMessage()}");
        }

        if (200 !== $statusCode) {
            throw new UploadException('An error occurred while cleaning folder. The response code is not 200');
        }

        try {
            $content = $response->toArray();
        } catch (ExceptionInterface $e) {
            throw new UploadException("Error parsing body: {$e->getMessage()}");
        }

        if (false === key_exists('ok', $content)) {
            throw new UploadException('Wrong signature body');
        }

        if (true === $content['ok']) {
            return;
        }

        if (false === key_exists('errors', $content) || false === is_array($content['errors'])) {
            throw new UploadException('Wrong signature body');
        }

        throw new UploadException(implode('', $content['errors']));
    }
}