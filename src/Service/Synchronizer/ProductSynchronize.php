<?php

namespace App\Service\Synchronizer;

use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductAttribute as ProductAttributeFront;
use App\Entity\Front\ProductCategory as ProductCategoryFront;
use App\Entity\Front\ProductDescription as ProductDescriptionFront;
use App\Entity\Front\ProductLayout as ProductLayoutFront;
use App\Entity\Front\ProductStore as ProductStoreFront;
use App\Entity\Product;
use App\Other\Fillers\ProductAttributeFiller;
use App\Other\Fillers\ProductCategoryFiller;
use App\Other\Fillers\ProductDescriptionFiller;
use App\Other\Fillers\ProductFiller;
use App\Other\Fillers\ProductLayoutFiller;
use App\Other\Fillers\ProductStoreFiller;
use App\Other\Store;
use App\Repository\AttributeRepository;
use App\Repository\Back\PhotoRepository as PhotoBackRepository;
use App\Repository\Back\ProductOptionsValuesRepository as AttributeBackRepository;
use App\Repository\Back\ProductPicturesRepository as ProductPicturesBackRepository;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use App\Repository\CategoryRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use App\Repository\Front\ProductAttributeRepository as ProductAttributeFrontRepository;
use App\Repository\Front\ProductCategoryRepository as ProductCategoryFrontRepository;
use App\Repository\Front\ProductDescriptionRepository as ProductDescriptionFrontRepository;
use App\Repository\Front\ProductDiscountRepository as ProductDiscountFrontRepository;
use App\Repository\Front\ProductDownloadRepository as ProductDownloadFrontRepository;
use App\Repository\Front\ProductFilterRepository as ProductFilterFrontRepository;
use App\Repository\Front\ProductImageRepository as ProductImageFrontRepository;
use App\Repository\Front\ProductLayoutRepository as ProductLayoutFrontRepository;
use App\Repository\Front\ProductOptionRepository as ProductOptionFrontRepository;
use App\Repository\Front\ProductOptionValueRepository as ProductOptionValueFrontRepository;
use App\Repository\Front\ProductRecurringRepository as ProductRecurringFrontRepository;
use App\Repository\Front\ProductRelatedRepository as ProductRelatedFrontRepository;
use App\Repository\Front\ProductRepository as ProductFrontRepository;
use App\Repository\Front\ProductRewardRepository as ProductRewardFrontRepository;
use App\Repository\Front\ProductSpecialRepository as ProductSpecialFrontRepository;
use App\Repository\Front\ProductStoreRepository as ProductStoreFrontRepository;
use App\Repository\ProductRepository;

class ProductSynchronize
{
    private $store;
    private $attributeRepository;
    private $categoryRepository;
    private $photoBackRepository;
    private $productRepository;
    private $categoryFrontRepository;
    private $productFrontRepository;
    private $productAttributeFrontRepository;
    private $productDescriptionFrontRepository;
    private $productDiscountFrontRepository;
    private $productFilterFrontRepository;
    private $productImageFrontRepository;
    private $productOptionFrontRepository;
    private $productOptionValueFrontRepository;
    private $productRecurringFrontRepository;
    private $productRelatedFrontRepository;
    private $productRewardFrontRepository;
    private $productSpecialFrontRepository;
    private $productCategoryFrontRepository;
    private $productDownloadFrontRepository;
    private $productLayoutFrontRepository;
    private $productStoreFrontRepository;
    private $attributeBackRepository;
    private $productBackRepository;
    private $productPicturesBackRepository;
    private $productImageSynchronizer;

    public function __construct(
        Store $store,
        AttributeRepository $attributeRepository,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        CategoryFrontRepository $categoryFrontRepository,
        PhotoBackRepository $photoBackRepository,
        ProductFrontRepository $productFrontRepository,
        ProductAttributeFrontRepository $productAttributeFrontRepository,
        ProductDescriptionFrontRepository $productDescriptionFrontRepository,
        ProductDiscountFrontRepository $productDiscountFrontRepository,
        ProductFilterFrontRepository $productFilterFrontRepository,
        ProductImageFrontRepository $productImageFrontRepository,
        ProductOptionFrontRepository $productOptionFrontRepository,
        ProductOptionValueFrontRepository $productOptionValueFrontRepository,
        ProductRecurringFrontRepository $productRecurringFrontRepository,
        ProductRelatedFrontRepository $productRelatedFrontRepository,
        ProductRewardFrontRepository $productRewardFrontRepository,
        ProductSpecialFrontRepository $productSpecialFrontRepository,
        ProductCategoryFrontRepository $productCategoryFrontRepository,
        ProductDownloadFrontRepository $productDownloadFrontRepository,
        ProductLayoutFrontRepository $productLayoutFrontRepository,
        ProductStoreFrontRepository $productStoreFrontRepository,
        AttributeBackRepository $attributeBackRepository,
        ProductBackRepository $productBackRepository,
        ProductPicturesBackRepository $productPicturesBackRepository,
        ProductImageSynchronizer $productImageSynchronizer)
    {
        $this->store = $store;
        $this->attributeRepository = $attributeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->categoryFrontRepository = $categoryFrontRepository;
        $this->photoBackRepository = $photoBackRepository;
        $this->productFrontRepository = $productFrontRepository;
        $this->productAttributeFrontRepository = $productAttributeFrontRepository;
        $this->productDescriptionFrontRepository = $productDescriptionFrontRepository;
        $this->productDiscountFrontRepository = $productDiscountFrontRepository;
        $this->productFilterFrontRepository = $productFilterFrontRepository;
        $this->productImageFrontRepository = $productImageFrontRepository;
        $this->productOptionFrontRepository = $productOptionFrontRepository;
        $this->productOptionValueFrontRepository = $productOptionValueFrontRepository;
        $this->productRecurringFrontRepository = $productRecurringFrontRepository;
        $this->productRelatedFrontRepository = $productRelatedFrontRepository;
        $this->productRewardFrontRepository = $productRewardFrontRepository;
        $this->productSpecialFrontRepository = $productSpecialFrontRepository;
        $this->productCategoryFrontRepository = $productCategoryFrontRepository;
        $this->productDownloadFrontRepository = $productDownloadFrontRepository;
        $this->productLayoutFrontRepository = $productLayoutFrontRepository;
        $this->productStoreFrontRepository = $productStoreFrontRepository;
        $this->attributeBackRepository = $attributeBackRepository;
        $this->productBackRepository = $productBackRepository;
        $this->productPicturesBackRepository = $productPicturesBackRepository;
        $this->productImageSynchronizer = $productImageSynchronizer;
    }

    public function reload($reloadImage = false)
    {
        $this->clear($reloadImage);
        $this->synchronize($reloadImage);
    }

    public function clear($clearImage = false)
    {
        $this->productRepository->removeAll();

        $this->productFrontRepository->removeAll();
        $this->productAttributeFrontRepository->removeAll();
        $this->productDescriptionFrontRepository->removeAll();
        $this->productDiscountFrontRepository->removeAll();
        $this->productFilterFrontRepository->removeAll();
        $this->productImageFrontRepository->removeAll();
        $this->productOptionFrontRepository->removeAll();
        $this->productOptionValueFrontRepository->removeAll();
        $this->productRecurringFrontRepository->removeAll();
        $this->productRelatedFrontRepository->removeAll();
        $this->productRewardFrontRepository->removeAll();
        $this->productSpecialFrontRepository->removeAll();
        $this->productCategoryFrontRepository->removeAll();
        $this->productLayoutFrontRepository->removeAll();
        $this->productStoreFrontRepository->removeAll();

        $this->productRepository->resetAutoIncrements();
        $this->productFrontRepository->resetAutoIncrements();
        $this->productAttributeFrontRepository->resetAutoIncrements();
        $this->productDiscountFrontRepository->resetAutoIncrements();
        $this->productImageFrontRepository->resetAutoIncrements();
        $this->productOptionFrontRepository->resetAutoIncrements();
        $this->productOptionValueFrontRepository->resetAutoIncrements();
        $this->productRewardFrontRepository->resetAutoIncrements();
        $this->productSpecialFrontRepository->resetAutoIncrements();

        if (true === $clearImage) {
            $this->productImageSynchronizer->clearFolder();
        }
    }

    public function synchronize($synchronizeImage = false)
    {
        $productsBack = $this->productBackRepository->findAll();
        foreach ($productsBack as $productBack) {
            $product = $this->productRepository->findOneByBackId($productBack->getProductId());
            if (null === $product) {
                $productFront = $this->createProductFrontFromBackProduct($productBack);
                $this->createProductFromBackAndFrontProductId($productBack->getProductId(), $productFront->getProductId());
            } else {
                $productFront = $this->productFrontRepository->find($product->getFrontId());
                if (null === $productFront) {
                    $this->productRepository->remove($product);
                    $productFront = $this->createProductFrontFromBackProduct($productBack);
                    $this->createProductFromBackAndFrontProductId($productBack->getProductId(), $productFront->getProductId());
                } else {
                    $this->updateProductFrontFromBackProduct($productBack, $productFront);
                    $this->productRepository->saveAndFlush($product);
                }
            }

            if (true === $synchronizeImage && null !== $productFront) {
                $this->synchronizeImage($productBack, $productFront);
            }
        }
    }

    protected function createProductFrontFromBackProduct(ProductBack $productBack)
    {
        $productFront = new ProductFront();
        ProductFiller::backToFront(
            $productBack,
            $productFront,
            $this->store->getAvailableStatusId(),
            $this->store->getNotAvailableStatusId()
        );
        $this->productFrontRepository->saveAndFlush($productFront);

        $productFrontId = $productFront->getProductId();
        $productDescriptionFront = new ProductDescriptionFront();

        if (null === $productFrontId) {
            die(var_dump($productFront));
        }

        ProductDescriptionFiller::backToFront(
            $productBack,
            $productDescriptionFront,
            $productFrontId,
            $this->store->getDefaultLanguageId()
        );
        $this->productDescriptionFrontRepository->saveAndFlush($productDescriptionFront);

        $storeId = $this->store->getDefaultStoreId();
        $productLayoutFront = new ProductLayoutFront();
        ProductLayoutFiller::backToFront(
            $productLayoutFront,
            $productFrontId,
            $storeId,
            $this->store->getDefaultLayoutId()
        );
        $this->productLayoutFrontRepository->saveAndFlush($productDescriptionFront);

        $productStoreFront = new ProductStoreFront();
        ProductStoreFiller::backToFront($productStoreFront, $productFrontId, $storeId);
        $this->productStoreFrontRepository->saveAndFlush($productStoreFront);

        $categoryFrontId = $this->getCategoryFrontIdByBack($productBack->getCategoryId());
        $productCategoryFront = new ProductCategoryFront();
        ProductCategoryFiller::backToFront($productCategoryFront, $productFrontId, $categoryFrontId);
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
            $this->productAttributeFrontRepository->saveAndFlush($productAttributeFront);
        }

        return $productFront;
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
            $text = trim($productAttribute->getOptionValue());
            if (mb_strlen($text) > 0) {
                $productAttributeFront = $this
                    ->productAttributeFrontRepository
                    ->findOneByAttributeFrontIdAndProductFrontId($attribute->getFrontId(), $productFrontId);
                if (null === $productAttributeFront) {
                    $productAttributeFront = new ProductAttributeFront();
                }
                ProductAttributeFiller::backToFront($productAttributeFront,
                    $productFrontId,
                    $attribute->getFrontId(),
                    $this->store->getDefaultLanguageId(),
                    $text
                );
                $this->productAttributeFrontRepository->save($productAttributeFront);
            }
        }
        $this->productAttributeFrontRepository->flush();

        return $productFrontId;
    }

    public function synchronizeImage(ProductBack $productBack, ProductFront $productFront)
    {
        $productBackImages = $this->productPicturesBackRepository->findByProductBackId($productBack->getProductId());
        foreach ($productBackImages as $key => $productBackImage) {
            $productFrontImage = $this->productImageSynchronizer->synchronizeProductImage(
                $productBackImage,
                $productFront,
                $key + 1
            );
            if (0 === $key) {
                $productFront->setImage($productFrontImage->getImage());
                $this->productFrontRepository->saveAndFlush($productFront);
                continue;
            }
            $this->productImageFrontRepository->saveAndFlush($productFrontImage);
        }

        $count = count($productBackImages) + 1;
        $photosBack = $this->photoBackRepository->findByProductBackId($productBack->getProductId());
        foreach ($photosBack as $key => $photoBack) {
            $productFrontImage = $this->productImageSynchronizer->synchronizePhoto(
                $photoBack,
                $productFront,
                $key + $count
            );
            $this->productImageFrontRepository->saveAndFlush($productFrontImage);
        }
    }
}