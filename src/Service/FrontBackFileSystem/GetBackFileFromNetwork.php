<?php

namespace App\Service\FrontBackFileSystem;

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
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getFile(string $path): ?string
    {
        $response = $this->httpClient->request('GET', $path);
        $headers = $response->getHeaders();

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

        $statusCode = $response->getStatusCode();
        if (200 !== $statusCode) {
            return null;
        }

        $content = $response->getContent();

        if (false === $content || 0 === strlen($content)) {
            return null;
        }

        return $content;
    }
}