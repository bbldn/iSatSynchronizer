<?php

namespace App\Service\FrontBackFileSystem;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GetBackFileFromNetwork implements GetBackFileInterface
{
    /** @var HttpClientInterface $httpClient */
    protected $httpClient;

    /**
     * GetBackFileFromNetwork constructor.
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $path
     * @return string
     */
    public function getFile(string $path): ?string
    {
        try {
            $response = $this->httpClient->request('GET', $path);
        } catch (TransportExceptionInterface $e) {
            return null;
        }

        try {
            $headers = $response->getHeaders();
        } catch (ClientExceptionInterface $e) {
            return null;
        } catch (RedirectionExceptionInterface $e) {
            return null;
        } catch (ServerExceptionInterface $e) {
            return null;
        } catch (TransportExceptionInterface $e) {
            return null;
        }

        if (false === key_exists('content-type', $headers)) {
            return null;
        }

        $contentType = $headers['content-type'];

        if (false === is_array($contentType) || 0 === count($contentType)) {
            return null;
        }

        $contentType = array_shift($contentType);

        if (0 === preg_match('/^image.+$/', $contentType)) {
            return null;
        }

        try {
            $statusCode = $response->getStatusCode();
        } catch (TransportExceptionInterface $e) {
            return null;
        }

        if (200 !== $statusCode) {
            return null;
        }

        try {
            $content = $response->getContent();
        } catch (ClientExceptionInterface $e) {
            return null;
        } catch (RedirectionExceptionInterface $e) {
            return null;
        } catch (ServerExceptionInterface $e) {
            return null;
        } catch (TransportExceptionInterface $e) {
            return null;
        }

        if (false === $content || 0 === strlen($content)) {
            return null;
        }

        return $content;
    }
}