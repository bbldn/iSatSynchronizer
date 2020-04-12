<?php

namespace App\Controller\API;

use App\Service\API\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductController extends AbstractController
{
    protected $productService;
    protected $httpClient;

    public function __construct(ProductService $productService, HttpClientInterface $httpClient)
    {
        $this->productService = $productService;
        $this->httpClient = $httpClient;
    }

    public function synchronizeProductsByCategoriesAction(Request $request)
    {
        if (!$request->request->has('ids')) {
            return JsonResponse::create(['ok' => false, 'errors' => ['parameter `ids` not found']]);
        }

        $ids = $request->request->get('ids');
        try {
            $this->httpClient->request('POST', 'http://localhost:8081', [
                'body' => ['command' => "product:synchronize {$ids} 1"],
            ]);
        } catch (TransportExceptionInterface $e) {
            return JsonResponse::create(['ok' => false, 'errors' => ['error connect']]);
        }

        return JsonResponse::create(['ok' => true]);
    }

    public function getCategoriesAction()
    {
        $result = [
            'ok' => true,
            'data' => [
                'categories' => $this->productService->getCategories(),
            ]
        ];

        return JsonResponse::create($result);
    }
}