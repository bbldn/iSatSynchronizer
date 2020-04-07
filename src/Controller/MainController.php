<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MainController extends AbstractController
{
    public function categoryAction(HttpClientInterface $httpClient, int $id)
    {
        try {
            $options = [
                'body' => ['command' => "category:one:synchronize {$id}"],
            ];

            $httpClient->request('POST', 'http://localhost:8081', $options);
        }catch (TransportExceptionInterface $e) {
            return JsonResponse::create(['ok' => false, 'errors' => [$e->getMessage()]]);
        }

        return JsonResponse::create(['ok' => true]);
    }

    public function productAction(HttpClientInterface $httpClient, int $id)
    {
        try {
            $options = [
                'body' => ['command' => "product:one:synchronize {$id}"],
            ];

            $httpClient->request('POST', 'http://localhost:8081', $options);
        }catch (TransportExceptionInterface $e) {
            return JsonResponse::create(['ok' => false, 'errors' => [$e->getMessage()]]);
        }

        return JsonResponse::create(['ok' => true]);
    }
}