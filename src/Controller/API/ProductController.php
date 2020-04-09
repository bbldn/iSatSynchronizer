<?php

namespace App\Controller\API;

use App\Service\API\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends AbstractController
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
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