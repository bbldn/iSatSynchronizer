<?php

namespace App\EventListener\FrontToBack;

use App\Event\FrontToBack\NewOrderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class TelegramOrderNew implements EventSubscriberInterface
{
    /** @var HttpClientInterface $httpClient */
    protected $httpClient;

    /** @var string $url */
    protected $url;

    /**
     * TelegramOrderNew constructor.
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
            NewOrderEvent::class => 'action',
        ];
    }

    /**
     * @param NewOrderEvent $event
     * @throws TransportExceptionInterface
     */
    public function action(NewOrderEvent $event): void
    {
        $order = $event->getOrder();

        $formData = new FormDataPart([
            'id' => (string)$order->getBackId(),
        ]);

        $response = $this->httpClient->request('POST', $this->url, [
            'headers' => $formData->getPreparedHeaders()->toArray(),
            'body' => $formData->bodyToIterable(),
        ]);

        $this->validateResponse($response);
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