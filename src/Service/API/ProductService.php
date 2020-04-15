<?php

namespace App\Service\API;

use App\Other\Back\CategoryTreeGenerator;
use App\Repository\Back\CategoryRepository as CategoryBackRepository;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductService
{
    protected $categoryBackRepository;
    protected $productBackRepository;
    protected $httpClient;
    protected $handlerPort;

    public function __construct(
        CategoryBackRepository $categoryBackRepository,
        ProductBackRepository $productBackRepository,
        HttpClientInterface $httpClient,
        string $handlerPort
    )
    {
        $this->categoryBackRepository = $categoryBackRepository;
        $this->productBackRepository = $productBackRepository;
        $this->httpClient = $httpClient;
        $this->handlerPort = $handlerPort;
    }

    public function updateProductsByIds(string $ids, bool $onlyPriceUpdate = false)
    {
        $command = (true === $onlyPriceUpdate) ? 'product:price:update:by-ids': 'product:synchronize:by-ids';

        try {
            $this->httpClient->request('POST', "http://localhost:{$this->handlerPort}", [
                'body' => ['command' => "{$command} {$ids}"]
            ]);
        } catch (TransportExceptionInterface $e) {
            return ['ok' => false, 'errors' => [$e->getMessage()]];
        }

        return ['ok' => true];
    }

    public function updateProductsByCategoriesIds(string $ids, bool $onlyPriceUpdate = false)
    {
        $command = (true === $onlyPriceUpdate) ? 'product:price:update:by-category-id': 'product:synchronize:by-category-id';

        try {
            $this->httpClient->request('POST', "http://localhost:{$this->handlerPort}", [
                'body' => ['command' => "{$command} {$ids}"]
            ]);
        } catch (TransportExceptionInterface $e) {
            return ['ok' => false, 'errors' => [$e->getMessage()]];
        }

        return ['ok' => true];
    }

    public function getCategories(): array
    {
        $result = [
            'ok' => true,
            'data' => [
                'categories' => CategoryTreeGenerator::generate($this->categoryBackRepository->findAllSortByParent()),
            ]
        ];

        return $result;
    }

    public function getProductsByName(string $name, int $max)
    {
        $result = [
            'ok' => true,
            'data' => [
                'products' => $this->productBackRepository->findByName($name, $max),
            ]
        ];

        return $result;
    }
}