<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Back\Product as ProductBack;
use App\Entity\Product;
use App\Entity\URL;
use App\Exception\CategoryBackNotFoundException;
use App\Exception\ProductBackNotFoundException;
use App\Exception\ProductNotFoundException;
use App\Other\Front\Store as StoreFront;
use App\Repository\Back\CategoryRepository as CategoryBackRepository;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use App\Repository\ProductRepository;
use App\Repository\URLRepository;
use Illuminate\Support\Str;

class ProductURLSynchronizer
{
    private $urlRepository;
    private $productRepository;
    private $productBackRepository;
    private $categoryBackRepository;

    public function __construct(
        URLRepository $urlRepository,
        ProductRepository $productRepository,
        ProductBackRepository $productBackRepository,
        CategoryBackRepository $categoryBackRepository
    )
    {
        $this->urlRepository = $urlRepository;
        $this->productRepository = $productRepository;
        $this->productBackRepository = $productBackRepository;
        $this->categoryBackRepository = $categoryBackRepository;
    }

    public function clear()
    {
        $this->urlRepository->clear();
        $this->urlRepository->resetAutoIncrements();
    }

    /**
     * @throws CategoryBackNotFoundException
     * @throws ProductBackNotFoundException
     */
    public function synchronizeAll()
    {
        $products = $this->productRepository->findAll();

        foreach ($products as $product) {
            $this->synchronizeProduct($product);
        }
    }

    /**
     * @param int $id
     * @throws CategoryBackNotFoundException
     * @throws ProductBackNotFoundException
     * @throws ProductNotFoundException
     */
    public function synchronizeOne(int $id)
    {
        $product = $this->productRepository->find($id);

        if (null === $product) {
            throw new ProductNotFoundException();
        }

        $this->synchronizeProduct($product);
    }

    /**
     * @param Product $product
     * @throws ProductBackNotFoundException
     * @throws CategoryBackNotFoundException
     */
    protected function synchronizeProduct(Product $product): void
    {
        $productBack = $this->productBackRepository->find($product->getBackId());

        if (null === $productBack) {
            throw new ProductBackNotFoundException();
        }

        $categoryBack = $this->categoryBackRepository->find($productBack->getCategoryId());

        if (null === $categoryBack) {
            throw new CategoryBackNotFoundException();
        }

        $url = $this->generateURL($categoryBack, $productBack);

        $productUrl = $this->urlRepository->findOneByBackId($product->getBackId());

        $this->createURL($productUrl, $product->getBackId(), $product->getFrontId(), $url);
    }

    protected function generateURL(CategoryBack $categoryBack, ProductBack $productBack): string
    {
        $categoryName = Str::lower(StoreFront::encodingConvert($categoryBack->getName()));
        $firstParty = $categoryBack->getCategoryId() . '-' . $categoryName;
        $productName = Str::lower(StoreFront::encodingConvert($productBack->getName()));
        $secondParty = $productBack->getProductId() . '-' . $productName;
        $full = '/' . $firstParty . '/' . $secondParty;

        $full = preg_replace('/[+,() ]/i', '-', $full);
        $full = preg_replace('/-{1,}/i', '-', $full);
        $full = preg_replace('/-?\/-?/i', '/', $full);
        $full = trim($full, '-');

        return $full;
    }

    protected function createURL(?URL $url, int $backId, int $frontId, string $text)
    {
        if (null === $url) {
            $url = new URL();
        }

        $url->setBackId($backId);
        $url->setFrontId($frontId);
        $url->setUrl($text);

        $this->urlRepository->saveAndFlush($url);
    }
}