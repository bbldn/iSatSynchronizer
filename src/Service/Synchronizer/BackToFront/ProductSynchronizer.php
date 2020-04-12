<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductAttribute as ProductAttributeFront;
use App\Entity\Front\ProductCategory as ProductCategoryFront;
use App\Entity\Front\ProductDescription as ProductDescriptionFront;
use App\Entity\Front\ProductLayout as ProductLayoutFront;
use App\Entity\Front\ProductStore as ProductStoreFront;
use App\Entity\Front\SeoUrl as SeoUrlFront;
use App\Entity\Product;
use App\Exception\ProductBackNotFoundException;
use App\Other\Back\Store as StoreBack;
use App\Other\Filler;
use App\Other\Front\Store as StoreFront;
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
use App\Repository\Front\SeoUrlRepository as SeoUrlFrontRepository;
use App\Repository\ProductRepository;
use Illuminate\Support\Str;

class ProductSynchronizer
{
    private $storeFront;
    private $storeBack;
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
    private $seoUrlFrontRepository;
    private $seoProEnabled;
    private $productImageSynchronizer;

    public function __construct(
        StoreFront $storeFront,
        StoreBack $storeBack,
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
        ProductImageSynchronizer $productImageSynchronizer,
        SeoUrlFrontRepository $seoUrlFrontRepository,
        bool $seoProEnabled
    )
    {
        $this->storeFront = $storeFront;
        $this->storeBack = $storeBack;
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
        $this->seoUrlFrontRepository = $seoUrlFrontRepository;
        $this->productImageSynchronizer = $productImageSynchronizer;
        $this->seoProEnabled = $seoProEnabled;
    }

    /**
     * @param bool $reloadImage
     */
    public function reload($reloadImage = false)
    {
        $this->clear($reloadImage);
        $this->synchronize($reloadImage);
    }

    /**
     * @param bool $clearImage
     */
    public function clear($clearImage = false): void
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

        if (true === $this->seoProEnabled) {
            $this->seoUrlFrontRepository->removeAllByQuery('product_id');
        }

        if (true === $clearImage) {
            $this->productImageSynchronizer->clearFolder();
        }
    }

    /**
     * @param bool $synchronizeImage
     */
    public function synchronize($synchronizeImage = false): void
    {
        $productsBack = $this->productBackRepository->findAll();
        foreach ($productsBack as $productBack) {
            $this->synchronizeProduct($productBack, $synchronizeImage);
        }
    }

    /**
     * @param int $id
     * @param bool $synchronizeImage
     * @throws ProductBackNotFoundException
     */
    public function synchronizeOne(int $id, $synchronizeImage = false): void
    {
        $productBack = $this->productBackRepository->find($id);

        if ($productBack === null) {
            throw new ProductBackNotFoundException();
        }

        $this->synchronizeProduct($productBack, $synchronizeImage);
    }

    public function synchronizeByCategoryId(int $id, $synchronizeImage = false): void
    {
        $productsBack = $this->productBackRepository->findByCategoryId($id);
        foreach ($productsBack as $productBack) {
            $this->synchronizeProduct($productBack, $synchronizeImage);
        }
    }

    /**
     * @param ProductBack $productBack
     * @param bool $synchronizeImage
     */
    protected function synchronizeProduct(ProductBack $productBack, $synchronizeImage = false): void
    {
        $product = $this->productRepository->findOneByBackId($productBack->getProductId());
        $productFront = $this->getProductFrontFromProduct($product);
        $this->updateProductFrontFromProductBack($productBack, $productFront);
        $this->createOrUpdateProduct(
            $product,
            $productBack->getProductId(),
            $productFront->getProductId()
        );

        if (true === $synchronizeImage && null !== $productFront) {
            $this->synchronizeImage($productBack, $productFront);
        }
    }

    /**
     * @param int|null $categoryBackId
     * @return int
     */
    protected function getCategoryFrontIdByBack(?int $categoryBackId): int
    {
        if (null === $categoryBackId) {
            //@TODO Notify
            return $this->storeFront->getDefaultCategoryFrontId();
        }

        $category = $this->categoryRepository->findOneByBackId($categoryBackId);
        if (null === $category) {
            //@TODO Notify
            return $this->storeFront->getDefaultCategoryFrontId();
        }

        $frontId = $category->getFrontId();
        if (null === $frontId) {
            //@TODO Notify
            return $this->storeFront->getDefaultCategoryFrontId();
        }

        $categoryFront = $this->categoryFrontRepository->find($frontId);
        if (null === $categoryFront) {
            //@TODO Notify
            return $this->storeFront->getDefaultCategoryFrontId();
        }

        return $categoryFront->getCategoryId();
    }

    /**
     * @param Product $product
     * @param int $backId
     * @param int $frontId
     */
    protected function createOrUpdateProduct(?Product $product, int $backId, int $frontId): void
    {
        if (null === $product) {
            $product = new Product();
        }
        $product->setBackId($backId);
        $product->setFrontId($frontId);
        $this->productRepository->saveAndFlush($product);
    }

    /**
     * @param ProductBack $productBack
     * @param ProductFront $productFront
     * @return ProductFront
     */
    protected function updateProductFrontFromProductBack(
        ProductBack $productBack,
        ProductFront $productFront
    ): ProductFront
    {
        $quantity = $productBack->getInStock();

        if ($quantity > 0) {
            $stockAvailableStatusId = $this->storeFront->getProductAvailableStatusId();
        } else {
            $stockAvailableStatusId = $this->storeFront->getProductNotAvailableStatusId();
        }

        $productFront->fill(
            'art' . $productBack->getProductId(),
            $productBack->getProductId(),
            Filler::securityString(null),
            Filler::securityString(null),
            Filler::securityString(null),
            Filler::securityString(null),
            Filler::securityString(null),
            Filler::securityString(null),
            $quantity,
            $stockAvailableStatusId,
            Filler::securityString(null),
            1,
            true,
            $productBack->getPrice(),
            0,
            0,
            new \DateTime('now'),
            0,
            0,
            0,
            0,
            0,
            0,
            false,
            true,
            0,
            $productBack->getEnabled() !== 0,
            0
        );

        $this->productFrontRepository->saveAndFlush($productFront);

        $productDescriptionFront = $this->productDescriptionFrontRepository->find($productFront->getProductId());
        if (null === $productDescriptionFront) {
            $productDescriptionFront = new ProductDescriptionFront();
        }

        $productDescriptionFront->fill(
            $productFront->getProductId(),
            $this->storeFront->getDefaultLanguageId(),
            Filler::securityString(Store::encodingConvert($productBack->getName())),
            Filler::securityString(Store::encodingConvert($productBack->getDescription())),
            Filler::securityString(null),
            Filler::securityString(Store::encodingConvert($productBack->getName())),
            Filler::securityString(null),
            Filler::securityString(null)
        );

        $this->productDescriptionFrontRepository->saveAndFlush($productDescriptionFront);

        $productLayoutFront = $this->productLayoutFrontRepository->find($productFront->getProductId());
        if (null === $productLayoutFront) {
            $productLayoutFront = new ProductLayoutFront();
        }

        $productLayoutFront->fill(
            $productFront->getProductId(),
            $this->storeFront->getDefaultStoreId(),
            $this->storeFront->getDefaultLayoutId()
        );

        $this->productLayoutFrontRepository->saveAndFlush($productLayoutFront);

        $productStoreFront = $this->productStoreFrontRepository->find($productFront->getProductId());
        if (null === $productStoreFront) {
            $productStoreFront = new ProductStoreFront();
        }
        $productStoreFront->fill(
            $productFront->getProductId(),
            $this->storeFront->getDefaultStoreId()
        );
        $this->productStoreFrontRepository->saveAndFlush($productStoreFront);

        $categoryFrontId = $this->getCategoryFrontIdByBack($productBack->getCategoryId());
        $productCategoryFront = $this->productCategoryFrontRepository->find($productFront->getProductId());
        if (null === $productCategoryFront) {
            $productCategoryFront = new ProductCategoryFront();
        }
        $productCategoryFront->fill(
            $productFront->getProductId(),
            $categoryFrontId,
            true
        );
        $this->productCategoryFrontRepository->saveAndFlush($productCategoryFront);

        $productFrontId = $productFront->getProductId();
        $this->synchronizeAttributes($productBack, $productFrontId);

        $seoUrl = $this->seoUrlFrontRepository->findOneByQueryAndLanguageId(
            'product_id=' . $productFrontId,
            $this->storeFront->getDefaultLanguageId()
        );
        $this->synchronizeSeoUrl($seoUrl, $productFrontId, $productBack);

        return $productFront;
    }

    protected function synchronizeAttributes(ProductBack $productBack, int $productFrontId)
    {
        $productAttributesBack = $this->attributeBackRepository->findAllByProductBackId($productBack->getProductId());
        foreach ($productAttributesBack as $productAttributeBack) {
            $attribute = $this->attributeRepository->findOneByBackId($productAttributeBack->getOptionId());
            if (null === $attribute) {
                // @TODO Notify
                continue;
            }
            $text = trim($productAttributeBack->getOptionValue());
            if (Str::length($text) > 0) {
                $this->productAttributeFrontRepository->removeByProductIdAttributeIdLanguageId(
                    $productFrontId,
                    $attribute->getFrontId(),
                    $this->storeFront->getDefaultLanguageId()
                );

                $productAttributeFront = new ProductAttributeFront();
                $productAttributeFront->fill(
                    $productFrontId,
                    $attribute->getFrontId(),
                    $this->storeFront->getDefaultLanguageId(),
                    $text
                );
                $this->productAttributeFrontRepository->saveAndFlush($productAttributeFront);
            }
        }
    }

    protected function synchronizeSeoUrl(?SeoUrlFront $seoUrl, int $productFrontId, ProductBack $productBack): void
    {
        if (null === $seoUrl) {
            $seoUrl = new SeoUrlFront();
        }
        $seoUrl->fill(
            $this->storeFront->getDefaultStoreId(),
            $this->storeFront->getDefaultLanguageId(),
            'product_id=' . $productFrontId,
            StoreFront::generateURL($productBack->getProductId(), Store::encodingConvert($productBack->getName()))
        );

        $this->seoUrlFrontRepository->saveAndFlush($seoUrl);
    }

    /**
     * @param ProductBack $productBack
     * @param ProductFront $productFront
     */
    public function synchronizeImage(ProductBack $productBack, ProductFront $productFront): void
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

    /**
     * @param Product|null $product
     * @return ProductFront
     */
    protected function getProductFrontFromProduct(?Product $product): ProductFront
    {
        if (null === $product) {
            return new ProductFront();
        }

        $productFront = $this->productFrontRepository->find($product->getFrontId());

        if (null === $productFront) {
            return new ProductFront();
        }

        return $productFront;
    }
}