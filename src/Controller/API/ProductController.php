<?php

namespace App\Controller\API;

use App\Service\API\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function updateProductsByIdsAction(Request $request)
    {
        if (!$request->request->has('ids')) {
            return JsonResponse::create(['ok' => false, 'errors' => ['parameter `ids` not found']]);
        }

        $result = $this->productService->updateProductsByIds(
            $request->request->get('ids'),
            $request->request->get('onlyPriceUpdate', false)
        );

        return JsonResponse::create($result);
    }

    public function updateProductsByCategoriesIdsAction(Request $request)
    {
        if (!$request->request->has('ids')) {
            return JsonResponse::create(['ok' => false, 'errors' => ['parameter `ids` not found']]);
        }

        $result = $this->productService->updateProductsByCategoriesIds(
            $request->request->get('ids'),
            $request->request->get('onlyPriceUpdate', false)
        );

        return JsonResponse::create($result);
    }

    public function getCategoriesAction()
    {
        return JsonResponse::create($this->productService->getCategories());
    }
}