<?php

namespace App\Service\Synchronizer;

use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductAttribute as ProductAttributeFront;
use App\Entity\Front\ProductCategory as ProductCategoryFront;
use App\Entity\Front\ProductDescription as ProductDescriptionFront;
use App\Entity\Front\ProductLayout as ProductLayoutFront;
use App\Entity\Front\ProductStore as ProductStoreFront;
use App\Entity\Product as Product;
use App\Other\Fillers\ProductAttributeFiller;
use App\Other\Fillers\ProductCategoryFiller;
use App\Other\Fillers\ProductDescriptionFiller;
use App\Other\Fillers\ProductFiller;
use App\Other\Fillers\ProductLayoutFiller;
use App\Other\Fillers\ProductStoreFiller;
use App\Other\Store;
use App\Repository\AttributeRepository;
use App\Repository\Back\ProductOptionsValuesRepository as AttributeBackRepository;
use App\Repository\Back\ProductRepository as ProductRepositoryBack;
use App\Repository\CategoryRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use App\Repository\Front\ProductAttributeRepository as ProductAttributeFrontRepository;
use App\Repository\Front\ProductCategoryRepository as ProductCategoryFrontRepository;
use App\Repository\Front\ProductDescriptionRepository as ProductDescriptionFrontRepository;
use App\Repository\Front\ProductLayoutRepository as ProductLayoutFrontRepository;
use App\Repository\Front\ProductRepository as ProductFrontRepository;
use App\Repository\Front\ProductStoreRepository as ProductStoreFrontRepository;
use App\Repository\ProductRepository;


class ProductSynchronize
{
    private $attributeRepository;
    private $attributeBackRepository;
    private $categoryRepository;
    private $categoryFrontRepository;
    private $productRepository;
    private $productBackRepository;
    private $productFrontRepository;
    private $productAttributeFrontRepository;
    private $productCategoryFrontRepository;
    private $productDescriptionFrontRepository;
    private $productLayoutFrontRepository;
    private $productStoreFrontRepository;
    private $store;

    public function __construct(
        AttributeRepository $attributeRepository,
        AttributeBackRepository $attributeBackRepository,
        CategoryRepository $categoryRepository,
        CategoryFrontRepository $categoryFrontRepository,
        ProductRepositoryBack $productBackRepository,
        ProductFrontRepository $productFrontRepository,
        ProductAttributeFrontRepository $productAttributeFrontRepository,
        ProductRepository $productRepository,
        ProductDescriptionFrontRepository $productDescriptionFrontRepository,
        ProductCategoryFrontRepository $productCategoryFrontRepository,
        ProductLayoutFrontRepository $productLayoutFrontRepository,
        ProductStoreFrontRepository $productStoreFrontRepository,
        Store $store)
    {
        $this->attributeRepository = $attributeRepository;
        $this->attributeBackRepository = $attributeBackRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categoryFrontRepository = $categoryFrontRepository;
        $this->productRepository = $productRepository;
        $this->productFrontRepository = $productFrontRepository;
        $this->productAttributeFrontRepository = $productAttributeFrontRepository;
        $this->productBackRepository = $productBackRepository;
        $this->productCategoryFrontRepository = $productCategoryFrontRepository;
        $this->productDescriptionFrontRepository = $productDescriptionFrontRepository;
        $this->productLayoutFrontRepository = $productLayoutFrontRepository;
        $this->productStoreFrontRepository = $productStoreFrontRepository;
        $this->store = $store;
    }

    public function clear($clearImage = false)
    {
        $this->productFrontRepository->removeAll();
        $this->productCategoryFrontRepository->removeAll();
        $this->productDescriptionFrontRepository->removeAll();
        $this->productDescriptionFrontRepository->removeAll();
        $this->productLayoutFrontRepository->removeAll();
        $this->productAttributeFrontRepository->removeAll();
    }

    public function reload($reloadImage = false)
    {
        $this->clear($reloadImage);
        $this->synchronize($reloadImage);
    }

    public function synchronize($synchronizeImage = false)
    {
        $productsBack = $this->productBackRepository->findAll();
        foreach ($productsBack as $productBack) {
            $product = $this->productRepository->findOneByBackId($productBack->getProductId());
            if (null === $product) {
                $frontId = $this->createProductFrontFromBackProduct($productBack);
                $this->createProductFromBackAndFrontProductId($productBack->getProductId(), $frontId);
            } else {
                $productFront = $this->productFrontRepository->find($product->getFrontId());
                if (null === $productFront) {
                    $this->productRepository->remove($product);
                    $frontId = $this->createProductFrontFromBackProduct($productBack);
                    $this->createProductFromBackAndFrontProductId($productBack->getProductId(), $frontId);
                } else {
                    $this->updateProductFrontFromBackProduct($productBack, $productFront);
                    $this->productRepository->saveAndFlush($product);
                }
            }
        }
    }

    protected function createProductFrontFromBackProduct(ProductBack $productBack)
    {
        $productFront = new ProductFront();
        ProductFiller::backToFront($productBack, $productFront, $this->store->getAvailableStatusId(), $this->store->getNotAvailableStatusId());
        $this->productFrontRepository->saveAndFlush($productFront);

        $productFrontId = $productFront->getProductId();
        $productDescriptionFront = new ProductDescriptionFront();
        ProductDescriptionFiller::backToFront($productBack, $productDescriptionFront, $productFrontId, $this->store->getDefaultLanguageId());
        $this->productDescriptionFrontRepository->saveAndFlush($productDescriptionFront);

        $storeId = $this->store->getDefaultStoreId();
        $productLayoutFront = new ProductLayoutFront();
        ProductLayoutFiller::backToFront($productLayoutFront, $productFrontId, $storeId, $this->store->getDefaultLayoutId());
        $this->productLayoutFrontRepository->saveAndFlush($productDescriptionFront);

        $productStoreFront = new ProductStoreFront();
        ProductStoreFiller::backToFront($productStoreFront, $productFrontId, $storeId);
        $this->productStoreFrontRepository->saveAndFlush($productStoreFront);

        $categoryFrontId = $this->getCategoryFrontIdByBack($productBack->getCategoryId());
        $productCategoryFront = new ProductCategoryFront();
        ProductCategoryFiller::backToFront($productCategoryFront, $productFrontId, $categoryFrontId, true);
        $this->productCategoryFrontRepository->saveAndFlush($productCategoryFront);

        $productAttributes = $this->attributeBackRepository->findAllByProductBackId($productBack->getProductId());
        foreach ($productAttributes as $productAttribute) {
            $attribute = $this->attributeRepository->findOneByBackId($productAttribute->getOptionId());
            if (null === $attribute) {
                // @TODO Notify
                continue;
            }
            $productAttributeFront = new ProductAttributeFront();
            ProductAttributeFiller::backToFront($productAttributeFront,
                $productFrontId,
                $attribute->getFrontId(),
                $this->store->getDefaultLanguageId(),
                $productAttribute->getOptionValue()
            );
            $this->productAttributeFrontRepository->save($productAttributeFront);
        }
        $this->productAttributeFrontRepository->flush();

        return $productFrontId;
    }

    protected function getCategoryFrontIdByBack(?int $categoryBackId)
    {
        if (null === $categoryBackId) {
            //@TODO Notify
            return $this->store->getDefaultCategoryFrontId();
        }

        $category = $this->categoryRepository->findOneByBackId($categoryBackId);
        if (null === $category) {
            //@TODO Notify
            return $this->store->getDefaultCategoryFrontId();
        }

        $frontId = $category->getFrontId();
        if (null === $frontId) {
            //@TODO Notify
            return $this->store->getDefaultCategoryFrontId();
        }

        $categoryFront = $this->categoryFrontRepository->find($frontId);
        if (null === $categoryFront) {
            //@TODO Notify
            return $this->store->getDefaultCategoryFrontId();
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

    protected function updateProductFrontFromBackProduct(ProductBack $productBack, ProductFront $productFront)
    {
        ProductFiller::backToFront($productBack, $productFront, $this->store->getAvailableStatusId(), $this->store->getNotAvailableStatusId());
        $this->productFrontRepository->saveAndFlush($productFront);

        $productFrontId = $productFront->getProductId();

        $productDescriptionFront = $this->productDescriptionFrontRepository->find($productFrontId);
        if (null === $productDescriptionFront) {
            $productDescriptionFront = new ProductDescriptionFront();
        }
        ProductDescriptionFiller::backToFront($productBack, $productDescriptionFront, $productFrontId, $this->store->getDefaultLanguageId());
        $this->productDescriptionFrontRepository->saveAndFlush($productDescriptionFront);

        $storeId = $this->store->getDefaultStoreId();
        $productLayoutFront = $this->productLayoutFrontRepository->find($productFrontId);
        if (null === $productLayoutFront) {
            $productLayoutFront = new ProductLayoutFront();
        }
        ProductLayoutFiller::backToFront($productLayoutFront, $productFrontId, $storeId, $this->store->getDefaultLayoutId());
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

        $productAttributes = $this->attributeBackRepository->findAllByProductBackId($productBack->getProductId());
        foreach ($productAttributes as $productAttribute) {
            $attribute = $this->attributeRepository->findOneByBackId($productAttribute->getOptionId());
            if (null === $attribute) {
                // @TODO Notify
                continue;
            }
            $productAttributeFront = $this->productAttributeFrontRepository->findOneByAttributeFrontIdAndProductFrontId($attribute->getFrontId(), $productFrontId);
            if (null === $productAttributeFront) {
                $productAttributeFront = new ProductAttributeFront();
            }
            ProductAttributeFiller::backToFront($productAttributeFront,
                $productFrontId,
                $attribute->getFrontId(),
                $this->store->getDefaultLanguageId(),
                $productAttribute->getOptionValue()
            );
            $this->productAttributeFrontRepository->save($productAttributeFront);
        }
        $this->productAttributeFrontRepository->flush();

        return $productFrontId;
    }
}