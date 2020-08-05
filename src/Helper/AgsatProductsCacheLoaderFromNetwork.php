<?php

namespace App\Helper;

use App\Contract\AgsatProductsCacheLoaderInterface;
use JsonException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

class AgsatProductsCacheLoaderFromNetwork implements AgsatProductsCacheLoaderInterface
{
    /** @var HttpClientInterface $httpClient */
    protected $httpClient;

    /** @var string $url */
    protected $url;

    /** @var string $token */
    protected $token;

    /**
     * AgsatProductsCacheLoaderFromNetwork constructor.
     * @param HttpClientInterface $httpClient
     * @param string $url
     * @param string $token
     */
    public function __construct(
        HttpClientInterface $httpClient,
        string $url,
        string $token
    )
    {
        $this->httpClient = $httpClient;
        $this->url = $url;
        $this->token = $token;
    }

    /**
     * @return array
     * @throws Throwable
     */
    public function load(): array
    {
        $response = $this->httpClient->request('GET', $this->url, [
            'auth_bearer' => $this->token,
        ]);

        $result = json_decode($response->getContent(), true);

        if (false === $result) {
            throw new JsonException('Error parse output');
        }

        return $result;
    }
}