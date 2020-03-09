<?php

namespace App\Service;

use App\Entity\Product as Product;
use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductDescription as ProductDescriptionFront;
use App\Entity\Front\ProductLayout as ProductLayoutFront;
use App\Entity\Front\ProductStore as ProductStoreFront;
use App\Entity\Front\ProductCategory as ProductCategoryFront;
use App\Other\Fillers\ProductCategoryFiller;
use App\Other\Fillers\ProductDescriptionFiller;
use App\Other\Fillers\ProductFiller;
use App\Other\Fillers\ProductLayoutFiller;
use App\Other\Fillers\ProductStoreFiller;
use App\Other\Store;
use App\Repository\Back\ProductRepository as ProductRepositoryBack;
use App\Repository\CategoryRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use App\Repository\Front\ProductDescriptionRepository as ProductDescriptionFrontRepository;
use App\Repository\Front\ProductCategoryRepository as ProductCategoryFrontRepository;
use App\Repository\Front\ProductLayoutRepository as ProductLayoutFrontRepository;
use App\Repository\Front\ProductStoreRepository as ProductStoreFrontRepository;
use App\Repository\Front\ProductRepository as ProductRepositoryFront;
use App\Repository\ProductRepository;


class ProductSynchronize
{
    private $categoryRepository;
    private $categoryFrontRepository;
    private $productRepository;
    private $productBackRepository;
    private $productFrontRepository;
    private $productCategoryFrontRepository;
    private $productDescriptionFrontRepository;
    private $productLayoutFrontRepository;
    private $productStoreFrontRepository;


    public function __construct(CategoryRepository $categoryRepository,
                                CategoryFrontRepository $categoryFrontRepository,
                                ProductRepositoryBack $productBackRepository,
                                ProductRepositoryFront $productFrontRepository,
                                ProductRepository $productRepository,
                                ProductDescriptionFrontRepository $productDescriptionFrontRepository,
                                ProductCategoryFrontRepository $productCategoryFrontRepository,
                                ProductLayoutFrontRepository $productLayoutFrontRepository,
                                ProductStoreFrontRepository $productStoreFrontRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryFrontRepository = $categoryFrontRepository;
        $this->productRepository = $productRepository;
        $this->productFrontRepository = $productFrontRepository;
        $this->productBackRepository = $productBackRepository;
        $this->productCategoryFrontRepository = $productCategoryFrontRepository;
        $this->productDescriptionFrontRepository = $productDescriptionFrontRepository;
        $this->productLayoutFrontRepository = $productLayoutFrontRepository;
        $this->productStoreFrontRepository = $productStoreFrontRepository;
    }

    public function synchronize($synchronizeImage = false)
    {
        $productsBack = $this->productBackRepository->findAll();
        foreach ($productsBack as $productBack) {
            $product = $this->productRepository->findOneByBackId($productBack->getProductId());
            if (null === $product) {
                $frontId = $this->createProductFrontFromBackCategory($productBack);
                $this->createProductFromBackAndFrontProductId($productBack->getProductId(), $frontId);
            } else {
                $productFront = $this->productFrontRepository->find($product->getFrontId());
                if (null === $productFront) {
                    $this->productRepository->remove($product);
                    $frontId = $this->createProductFrontFromBackCategory($productBack);
                    $this->createProductFromBackAndFrontProductId($productBack->getProductId(), $frontId);
                } else {
                    $this->updateProductFrontFromBackProduct($productBack, $productFront);
                    $this->productRepository->saveAndFlush($product);
                }
            }
        }
    }

    protected function updateProductFrontFromBackProduct(ProductBack $productBack, ProductFront $productFront)
    {
        ProductFiller::backToFront($productBack, $productFront, Store::getAvailableStatusId(), Store::getNotAvailableStatusId());
        $this->productFrontRepository->saveAndFlush($productFront);

        $productFrontId = $productFront->getProductId();

        $productDescriptionFront = $this->productDescriptionFrontRepository->find($productFrontId);
        if (null === $productDescriptionFront) {
            $productDescriptionFront = new ProductDescriptionFront();
        }
        ProductDescriptionFiller::backToFront($productBack, $productDescriptionFront, $productFrontId, Store::getDefaultLanguageId());
        $this->productDescriptionFrontRepository->saveAndFlush($productDescriptionFront);

        $storeId = Store::getDefaultStoreId();
        $productLayoutFront = $this->productLayoutFrontRepository->find($productFrontId);
        if (null === $productLayoutFront) {
            $productLayoutFront = new ProductLayoutFront();
        }
        ProductLayoutFiller::backToFront($productLayoutFront, $productFrontId, $storeId, Store::getDefaultLayoutId());
        $this->productLayoutFrontRepository->saveAndFlush($productLayoutFront);

        $productStoreFront = $this->productStoreFrontRepository->find($productFrontId);
        if (null === $productStoreFront) {
            $productStoreFront = new ProductStoreFront();
        }
        ProductStoreFiller::backToFront($productStoreFront, $productFrontId, $storeId);
        $this->productStoreFrontRepository->saveAndFlush($productStoreFront);

        $categoryFrontId = $this->getCategoryFrontIdByBack($productBack->getCategoryId());
        $productCategoryFront = $this->productCategoryFrontRepository->find($productFrontId);
        if (null === $productCategoryFront) {
            $productCategoryFront = new ProductCategoryFront();
        }
        ProductCategoryFiller::backToFront($productCategoryFront, $productFrontId, $categoryFrontId, true);
        $this->productCategoryFrontRepository->saveAndFlush($productCategoryFront);

        return $productFrontId;
    }

    protected function createProductFrontFromBackCategory(ProductBack $productBack)
    {
        $productFront = new ProductFront();
        ProductFiller::backToFront($productBack, $productFront, Store::getAvailableStatusId(), Store::getNotAvailableStatusId());
        $this->productFrontRepository->saveAndFlush($productFront);

        $productFrontId = $productFront->getProductId();
        $productDescriptionFront = new ProductDescriptionFront();
        ProductDescriptionFiller::backToFront($productBack, $productDescriptionFront, $productFrontId, Store::getDefaultLanguageId());
        $this->productDescriptionFrontRepository->saveAndFlush($productDescriptionFront);

        $storeId = Store::getDefaultStoreId();
        $productLayoutFront = new ProductLayoutFront();
        ProductLayoutFiller::backToFront($productLayoutFront, $productFrontId, $storeId, Store::getDefaultLayoutId());
        $this->productLayoutFrontRepository->saveAndFlush($productDescriptionFront);

        $productStoreFront = new ProductStoreFront();
        ProductStoreFiller::backToFront($productStoreFront, $productFrontId, $storeId);
        $this->productStoreFrontRepository->saveAndFlush($productStoreFront);

        $categoryFrontId = $this->getCategoryFrontIdByBack($productBack->getCategoryId());
        $productCategoryFront = new ProductCategoryFront();
        ProductCategoryFiller::backToFront($productCategoryFront, $productFrontId, $categoryFrontId, true);
        $this->productCategoryFrontRepository->saveAndFlush($productCategoryFront);

        return $productFrontId;
    }

    protected function getCategoryFrontIdByBack(?int $categoryBackId)
    {
        if (null === $categoryBackId) {
            //@TODO Notify
            return Store::getDefaultCategoryFrontId();
        }

        $category = $this->categoryRepository->findOneByBackId($categoryBackId);
        if (null === $category) {
            //@TODO Notify
            return Store::getDefaultCategoryFrontId();
        }

        $frontId = $category->getFrontId();
        if (null === $frontId) {
            //@TODO Notify
            return Store::getDefaultCategoryFrontId();
        }

        $categoryFront = $this->categoryFrontRepository->find($frontId);
        if (null === $categoryFront) {
            //@TODO Notify
            return Store::getDefaultCategoryFrontId();
        }

        return $categoryFront->getCategoryId();
    }

    protected function createProductFromBackAndFrontProductId(int $backId, int $frontId)
    {
        $category = new Product();
        $category->setBackId($backId);
        $category->setFrontId($frontId);
        $this->productRepository->saveAndFlush($category);
    }
}