<?php

namespace App\Controller\API;

use App\Controller\Controller;
use App\Helper\Errorer;
use App\Service\API\ProductService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends Controller
{
    /** @var ProductService $productService */
    protected $productService;

    /**
     * ProductController constructor.
     * @param ValidatorInterface $validator
     * @param ProductService $productService
     */
    public function __construct(ValidatorInterface $validator, ProductService $productService)
    {
        parent::__construct($validator);
        $this->productService = $productService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function updateProductsByIdsAction(Request $request): Response
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
            return $this->json([
                'ok' => false,
                'errors' => Errorer::convertConstraintViolationListToArray($errors)
            ]);
        }

        $result = $this->productService->updateProductsByIds(
            $request->request->get('ids'),
            $request->request->get('onlyPriceUpdate', false)
        );

        return $this->json($result);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function updateProductsByCategoriesIdsAction(Request $request): Response
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
            return $this->json([
                'ok' => false,
                'errors' => Errorer::convertConstraintViolationListToArray($errors)
            ]);
        }

        $result = $this->productService->updateProductsByCategoriesIds(
            $request->request->get('ids'),
            (bool)$request->request->get('onlyPriceUpdate', false)
        );

        return $this->json($result);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function getProductsByNameAction(Request $request): Response
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
            return $this->json([
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

        return $this->json($result);
    }

    /**
     * @return Response
     */
    public function getCategoriesAction(): Response
    {
        return $this->json($this->productService->getCategories());
    }
}