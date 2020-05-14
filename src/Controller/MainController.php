<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MainController extends AbstractController
{
    /**
     * @param HttpClientInterface $httpClient
     * @param int $id
     * @return Response
     */
    public function categoryAction(HttpClientInterface $httpClient, int $id): Response
    {
        try {
            $options = [
                'body' => ['command' => "category:one:synchronize {$id}"],
            ];

            $httpClient->request('POST', 'http://localhost:8081', $options);
        } catch (TransportExceptionInterface $e) {
            return $this->json(['ok' => false, 'errors' => [$e->getMessage()]]);
        }

        return $this->json(['ok' => true]);
    }


    /**
     * @param HttpClientInterface $httpClient
     * @param int $id
     * @return Response
     */
    public function productAction(HttpClientInterface $httpClient, int $id): Response
    {
        try {
            $options = [
                'body' => ['command' => "product:one:synchronize {$id}"],
            ];

            $httpClient->request('POST', 'http://localhost:8081', $options);
        } catch (TransportExceptionInterface $e) {
            return $this->json(['ok' => false, 'errors' => [$e->getMessage()]]);
        }

        return $this->json(['ok' => true]);
    }
}