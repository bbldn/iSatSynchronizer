<?php

namespace App\Service\API;

use App\Helper\Back\CategoryTreeGenerator;
use App\Repository\Back\CategoryRepository as CategoryBackRepository;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductService extends ApiService
{
    /** @var CategoryBackRepository $categoryBackRepository */
    protected $categoryBackRepository;

    /** @var ProductBackRepository $productBackRepository */
    protected $productBackRepository;

    /** @var HttpClientInterface $httpClient */
    protected $httpClient;

    /** @var string $handlerPort */
    protected $handlerPort;

    /**
     * ProductService constructor.
     * @param CategoryBackRepository $categoryBackRepository
     * @param ProductBackRepository $productBackRepository
     * @param HttpClientInterface $httpClient
     * @param string $handlerPort
     */
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

    /**
     * @param string $ids
     * @param bool $onlyPriceUpdate
     * @return array
     */
    public function updateProductsByIds(string $ids, bool $onlyPriceUpdate = false): array
    {
        if (true === $onlyPriceUpdate) {
            $command = 'product:price:update:by-ids';
        } else {
            $command = 'product:synchronize:by-ids';
        }

        try {
            $this->httpClient->request('POST', "http://localhost:{$this->handlerPort}", [
                'body' => ['command' => "{$command} {$ids}"]
            ]);
        } catch (TransportExceptionInterface $e) {
            return ['ok' => false, 'errors' => [$e->getMessage()]];
        }

        return ['ok' => true];
    }

    /**
     * @param string $ids
     * @param bool $onlyPriceUpdate
     * @return array
     */
    public function updateProductsByCategoriesIds(string $ids, bool $onlyPriceUpdate = false): array
    {
        if (true === $onlyPriceUpdate) {
            $command = 'product:price:update:by-category-id';
        } else {
            $command = 'product:synchronize:by-category-id';
        }

        try {
            $this->httpClient->request('POST', "http://localhost:{$this->handlerPort}", [
                'body' => ['command' => "{$command} {$ids}"]
            ]);
        } catch (TransportExceptionInterface $e) {
            return ['ok' => false, 'errors' => [$e->getMessage()]];
        }

        return ['ok' => true];
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        $result = [
            'ok' => true,
            'data' => [
                'categories' => CategoryTreeGenerator::generate($this->categoryBackRepository->findSortedByParent()),
            ]
        ];

        return $result;
    }

    /**
     * @param string $name
     * @param int $max
     * @return array
     */
    public function getProductsByName(string $name, int $max): array
    {
        $result = [
            'ok' => true,
            'data' => [
                'products' => $this->productBackRepository->getByNameWithMax($name, $max),
            ]
        ];

        return $result;
    }
}