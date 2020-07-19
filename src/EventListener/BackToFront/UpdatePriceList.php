<?php

namespace App\EventListener\BackToFront;

use App\Event\BackToFront\CategorySynchronizedEvent;
use App\Event\BackToFront\CurrencySynchronizedEvent;
use App\Event\BackToFront\PriceSynchronizeAllFastEvent;
use App\Event\BackToFront\PriceSynchronizeEvent;
use App\Event\BackToFront\PriceSynchronizeFastEvent;
use App\Event\BackToFront\ProductSynchronizedEvent;
use App\Helper\ExceptionFormatter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Throwable;

class UpdatePriceList implements EventSubscriberInterface
{
    /** @var HttpClientInterface $httpClient */
    protected $httpClient;

    /** @var string $url */
    protected $url;

    /**
     * UpdatePriceList constructor.
     * @param HttpClientInterface $httpClient
     * @param string $url
     */
    public function __construct(HttpClientInterface $httpClient, string $url)
    {
        $this->httpClient = $httpClient;
        $this->url = $url;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ProductSynchronizedEvent::class => 'action',
            CategorySynchronizedEvent::class => 'action',
            PriceSynchronizeEvent::class => 'action',
            PriceSynchronizeFastEvent::class => 'action',
            PriceSynchronizeAllFastEvent::class => 'action',
            CurrencySynchronizedEvent::class => 'action',
        ];
    }

    /**
     *
     */
    public function action(): void
    {
        $formData = new FormDataPart([
            'command' => 'generate:all',
        ]);

        try {
            $response = $this->httpClient->request('POST', $this->url, [
                'headers' => $formData->getPreparedHeaders()->toArray(),
                'body' => $formData->bodyToIterable(),
            ]);

            $this->validateResponse($response);
        } catch (Throwable $e) {
            ExceptionFormatter::e($e);
        }
    }

    /**
     * @param ResponseInterface $response
     */
    protected function validateResponse(ResponseInterface $response): void
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