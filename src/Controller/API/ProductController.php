<?php

namespace App\Controller\API;

use App\Controller\Controller;
use App\Other\Errorer;
use App\Service\API\ProductService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ValidatorInterface $validator, ProductService $productService)
    {
        parent::__construct($validator);
        $this->productService = $productService;
    }

    public function updateProductsByIdsAction(Request $request): JsonResponse
    {
        $constraint = $this->getValidationCollection([
            'ids' => new Assert\Required(
                new Assert\Regex(['pattern' => '/^([0-9]+,?)+$/i', 'message' => 'Field `ids` is invalid'])
            ),
            'onlyPriceUpdate' => new Assert\Optional([
                new Assert\Choice(['choices' => ['0', '1']])
            ]),
        ]);

        $errors = $this->validator->validate($request->request->all(), $constraint);

        if ($errors->count() > 0) {
            return JsonResponse::create([
                'ok' => false,
                'errors' => Errorer::convertConstraintViolationListToArray($errors)
            ]);
        }

        $result = $this->productService->updateProductsByIds(
            $request->request->get('ids'),
            $request->request->get('onlyPriceUpdate', false)
        );

        return JsonResponse::create($result);
    }

    public function updateProductsByCategoriesIdsAction(Request $request): JsonResponse
    {
        $constraint = $this->getValidationCollection([
            'ids' => new Assert\Required(
                new Assert\Regex(['pattern' => '/^([0-9]+,?)+$/i', 'message' => 'Field `ids` is invalid'])
            ),
            'onlyPriceUpdate' => new Assert\Optional([
                new Assert\Choice(['choices' => ['0', '1']])
            ]),
        ]);

        $errors = $this->validator->validate($request->request->all(), $constraint);

        if ($errors->count() > 0) {
            return JsonResponse::create([
                'ok' => false,
                'errors' => Errorer::convertConstraintViolationListToArray($errors)
            ]);
        }

        $result = $this->productService->updateProductsByCategoriesIds(
            $request->request->get('ids'),
            (bool)$request->request->get('onlyPriceUpdate', false)
        );

        return JsonResponse::create($result);
    }

    public function getProductsByNameAction(Request $request)
    {
        $constraint = $this->getValidationCollection([
            'name' => new Assert\Required(),
            'max' => new Assert\Optional([
                new Assert\NotBlank(['message' => 'Field `max` is empty']),
                new Assert\Regex(['pattern' => '/^-?[0-9]+$/', 'message' => 'Field `max` must be number'])
            ]),
        ]);

        $errors = $this->validator->validate($request->request->all(), $constraint);

        if ($errors->count() > 0) {
            return JsonResponse::create([
                'ok' => false,
                'errors' => Errorer::convertConstraintViolationListToArray($errors)
            ]);
        }

        $result = ['ok' => true, 'data' => ['products' => []]];
        $name = $request->request->get('name');
        if (mb_strlen($name) > 0) {
            $result = $this->productService->getProductsByName(
                $name,
                (int)$request->request->get('max', 10)
            );
        }

        return JsonResponse::create($result);
    }

    public function getCategoriesAction(): JsonResponse
    {
        return JsonResponse::create($this->productService->getCategories());
    }
}