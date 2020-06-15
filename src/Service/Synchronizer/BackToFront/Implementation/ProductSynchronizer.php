<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductAttribute as ProductAttributeFront;
use App\Entity\Front\ProductCategory as ProductCategoryFront;
use App\Entity\Front\ProductDescription as ProductDescriptionFront;
use App\Entity\Front\ProductDiscontinued as ProductDiscontinuedFront;
use App\Entity\Front\ProductLayout as ProductLayoutFront;
use App\Entity\Front\ProductStore as ProductStoreFront;
use App\Entity\Front\SeoUrl as SeoUrlFront;
use App\Entity\Product;
use App\Helper\Back\Store as StoreBack;
use App\Helper\ExceptionFormatter;
use App\Helper\Filler;
use App\Helper\Front\Store as StoreFront;
use App\Helper\Store;
use App\Repository\AttributeRepository;
use App\Repository\Back\CurrencyRepository as CurrencyBackRepository;
use App\Repository\Back\PhotoRepository as PhotoBackRepository;
use App\Repository\Back\ProductOptionsValuesRepository as AttributeBackRepository;
use App\Repository\Back\ProductPicturesRepository as ProductPicturesBackRepository;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use App\Repository\CategoryRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use App\Repository\Front\ManufacturerRepository as ManufacturerFrontRepository;
use App\Repository\Front\ProductAttributeRepository as ProductAttributeFrontRepository;
use App\Repository\Front\ProductCategoryRepository as ProductCategoryFrontRepository;
use App\Repository\Front\ProductDescriptionRepository as ProductDescriptionFrontRepository;
use App\Repository\Front\ProductDiscontinuedRepository as ProductDiscontinuedFrontRepository;
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
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;
use App\Service\Synchronizer\BackToFront\DescriptionSynchronizer;
use App\Service\Synchronizer\BackToFront\ProductDiscountSynchronizer as ProductDiscountBackToFrontSynchronizer;
use DateTime;
use Psr\Log\LoggerInterface;

class ProductSynchronizer extends BackToFrontSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var StoreBack $storeBack */
    protected $storeBack;

    /** @var AttributeRepository $attributeRepository */
    protected $attributeRepository;

    /** @var CategoryRepository $categoryRepository */
    protected $categoryRepository;

    /** @var PhotoBackRepository $photoBackRepository */
    protected $photoBackRepository;

    /** @var ProductRepository $productRepository */
    protected $productRepository;

    /** @var CategoryFrontRepository $categoryFrontRepository */
    protected $categoryFrontRepository;

    /** @var ProductFrontRepository $productFrontRepository */
    protected $productFrontRepository;

    /** @var ProductAttributeFrontRepository $productAttributeFrontRepository */
    protected $productAttributeFrontRepository;

    /** @var ProductDescriptionFrontRepository $productDescriptionFrontRepository */
    protected $productDescriptionFrontRepository;

    /** @var ProductDiscountFrontRepository $productDiscountFrontRepository */
    protected $productDiscountFrontRepository;

    /** @var ProductFilterFrontRepository $productFilterFrontRepository */
    protected $productFilterFrontRepository;

    /** @var ProductImageFrontRepository $productImageFrontRepository */
    protected $productImageFrontRepository;

    /** @var ProductOptionFrontRepository $productOptionFrontRepository */
    protected $productOptionFrontRepository;

    /** @var ProductOptionValueFrontRepository $productOptionValueFrontRepository */
    protected $productOptionValueFrontRepository;

    /** @var ProductRecurringFrontRepository $productRecurringFrontRepository */
    protected $productRecurringFrontRepository;

    /** @var ProductRelatedFrontRepository $productRelatedFrontRepository */
    protected $productRelatedFrontRepository;

    /** @var ProductRewardFrontRepository $productRewardFrontRepository */
    protected $productRewardFrontRepository;

    /** @var ProductSpecialFrontRepository $productSpecialFrontRepository */
    protected $productSpecialFrontRepository;

    /** @var ProductCategoryFrontRepository $productCategoryFrontRepository */
    protected $productCategoryFrontRepository;

    /** @var ProductDownloadFrontRepository $productDownloadFrontRepository */
    protected $productDownloadFrontRepository;

    /** @var ProductLayoutFrontRepository $productLayoutFrontRepository */
    protected $productLayoutFrontRepository;

    /** @var ProductStoreFrontRepository $productStoreFrontRepository */
    protected $productStoreFrontRepository;

    /** @var AttributeBackRepository $attributeBackRepository */
    protected $attributeBackRepository;

    /** @var ProductBackRepository $productBackRepository */
    protected $productBackRepository;

    /** @var ProductPicturesBackRepository $productPicturesBackRepository */
    protected $productPicturesBackRepository;

    /** @var ProductImageSynchronizer $productImageSynchronizer */
    protected $productImageSynchronizer;

    /** @var SeoUrlFrontRepository $seoUrlFrontRepository */
    protected $seoUrlFrontRepository;

    /** @var ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository */
    protected $productDiscontinuedFrontRepository;

    /** @var ManufacturerFrontRepository $manufacturerFrontRepository */
    protected $manufacturerFrontRepository;

    /** @var CurrencyBackRepository $currencyBackRepository */
    protected $currencyBackRepository;

    /** @var ProductDiscountBackToFrontSynchronizer $productDiscountBackToFrontSynchronizer */
    protected $productDiscountBackToFrontSynchronizer;

    /** @var DescriptionSynchronizer $descriptionSynchronizer */
    protected $descriptionSynchronizer;

    /** @var string $defaultImagePath */
    protected $defaultImagePath = null;

    /** @var bool $seoUrlTableExists */
    protected $seoUrlTableExists = false;

    /** @var bool $seoUrlTableExists */
    protected $productDiscontinuedTableExists = false;

    /** @var bool $synchronizeImage */
    protected $synchronizeImage = false;

    /**
     * ProductSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param StoreFront $storeFront
     * @param StoreBack $storeBack
     * @param AttributeRepository $attributeRepository
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     * @param CategoryFrontRepository $categoryFrontRepository
     * @param PhotoBackRepository $photoBackRepository
     * @param ProductFrontRepository $productFrontRepository
     * @param ProductAttributeFrontRepository $productAttributeFrontRepository
     * @param ProductDescriptionFrontRepository $productDescriptionFrontRepository
     * @param ProductDiscountFrontRepository $productDiscountFrontRepository
     * @param ProductFilterFrontRepository $productFilterFrontRepository
     * @param ProductImageFrontRepository $productImageFrontRepository
     * @param ProductOptionFrontRepository $productOptionFrontRepository
     * @param ProductOptionValueFrontRepository $productOptionValueFrontRepository
     * @param ProductRecurringFrontRepository $productRecurringFrontRepository
     * @param ProductRelatedFrontRepository $productRelatedFrontRepository
     * @param ProductRewardFrontRepository $productRewardFrontRepository
     * @param ProductSpecialFrontRepository $productSpecialFrontRepository
     * @param ProductCategoryFrontRepository $productCategoryFrontRepository
     * @param ProductDownloadFrontRepository $productDownloadFrontRepository
     * @param ProductLayoutFrontRepository $productLayoutFrontRepository
     * @param ProductStoreFrontRepository $productStoreFrontRepository
     * @param AttributeBackRepository $attributeBackRepository
     * @param ProductBackRepository $productBackRepository
     * @param ProductPicturesBackRepository $productPicturesBackRepository
     * @param ProductImageSynchronizer $productImageSynchronizer
     * @param SeoUrlFrontRepository $seoUrlFrontRepository
     * @param ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository
     * @param ManufacturerFrontRepository $manufacturerFrontRepository
     * @param CurrencyBackRepository $currencyBackRepository
     * @param ProductDiscountBackToFrontSynchronizer $productDiscountBackToFrontSynchronizer
     * @param DescriptionSynchronizer $descriptionSynchronizer
     */
    public function __construct(
        LoggerInterface $logger,
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
        ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository,
        ManufacturerFrontRepository $manufacturerFrontRepository,
        CurrencyBackRepository $currencyBackRepository,
        ProductDiscountBackToFrontSynchronizer $productDiscountBackToFrontSynchronizer,
        DescriptionSynchronizer $descriptionSynchronizer
    )
    {
        $this->logger = $logger;
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
        $this->productDiscontinuedFrontRepository = $productDiscontinuedFrontRepository;
        $this->manufacturerFrontRepository = $manufacturerFrontRepository;
        $this->currencyBackRepository = $currencyBackRepository;
        $this->productDiscountBackToFrontSynchronizer = $productDiscountBackToFrontSynchronizer;
        $this->descriptionSynchronizer = $descriptionSynchronizer;

        $this->seoUrlTableExists = $seoUrlFrontRepository->tableExists();
        $this->productDiscontinuedTableExists = $productDiscontinuedFrontRepository->tableExists();
    }

    /**
     * @param bool $clearImage
     */
    protected function clear($clearImage = false): void
    {
        $this->synchronizeImage = $clearImage;
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

        if (true === $this->productDiscontinuedTableExists) {
            $this->productDiscontinuedFrontRepository->removeAll();
            $this->productDiscontinuedFrontRepository->resetAutoIncrements();
        }

        if (true === $this->seoUrlTableExists) {
            $this->seoUrlFrontRepository->removeAllByQuery('product_id');
        }

        if (true === $this->synchronizeImage) {
            $this->productImageSynchronizer->clearFolder();
            $this->descriptionSynchronizer->clearFolder();
        }
    }

    /**
     * @param ProductBack $productBack
     * @param bool $synchronizeImage
     */
    protected function synchronizeProduct(ProductBack $productBack, $synchronizeImage = false): void
    {
        $this->synchronizeImage = $synchronizeImage;

        $product = $this->productRepository->findOneByBackId($productBack->getProductId());
        $productFront = $this->getProductFrontFromProduct($product);
        $this->updateProductFrontFromProductBack($productBack, $productFront);
        $this->createOrUpdateProduct(
            $product,
            $productBack->getProductId(),
            $productFront->getProductId()
        );
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
            $stockAvailableStatusId = $this->storeFront->getDefaultProductAvailableStatusId();
        } else {
            $stockAvailableStatusId = $this->storeFront->getDefaultProductNotAvailableStatusId();
        }

        $productFront->setModel('art' . $productBack->getProductId());
        $productFront->setSku($productBack->getProductId());
        $productFront->setUpc(Filler::securityString(null));
        $productFront->setEan(Filler::securityString(null));
        $productFront->setJan(Filler::securityString(null));
        $productFront->setIsbn(Filler::securityString(null));
        $productFront->setMpn(Filler::securityString(null));
        $productFront->setLocation(Filler::securityString(null));
        $productFront->setQuantity($quantity);
        $productFront->setStockStatusId($stockAvailableStatusId);
        $productName = Filler::securityString(Store::encodingConvert($productBack->getName()));
        $productFront->setManufacturerId($this->getManufacturerId($productName));
        $productFront->setShipping(true);
        $productFront->setPrice($productBack->getPrice());
        $productFront->setPoints(0);
        $productFront->setTaxClassId(0);
        $productFront->setDateAvailable(new DateTime('now'));
        $productFront->setLength(0);
        $productFront->setWeight(0);
        $productFront->setWeightClassId(0);
        $productFront->setHeight(0);
        $productFront->setLengthClassId(0);
        $productFront->setSubtract(false);
        $productFront->setMinimum(true);
        $productFront->setSortOrder($productBack->getSortOrder());
        if (null === $productFront->getStatus() || true === $productFront->getStatus()) {
            $productFront->setStatus($productBack->getEnabled() !== 0);
        }

        if (null === $productFront->getViewed()) {
            $productFront->setViewed(0);
        }

        $this->productFrontRepository->persistAndFlush($productFront);
        $productFrontId = $productFront->getProductId();

        $productDescriptionFront = $this->productDescriptionFrontRepository->find($productFront->getProductId());
        if (null === $productDescriptionFront) {
            $productDescriptionFront = new ProductDescriptionFront();
        }

        $productDescriptionFront->setProductId($productFrontId);
        $productDescriptionFront->setLanguageId($this->storeFront->getDefaultLanguageId());
        $productDescriptionFront->setName($productName);

        if (true === $this->synchronizeImage) {
            $productDescriptionFront->setDescription(
                $this->descriptionSynchronizer->synchronize(trim(Store::encodingConvert($productBack->getDescription())))
            );
        } else {
            $productDescriptionFront->setDescription(trim(Store::encodingConvert($productBack->getDescription())));
        }

        $productDescriptionFront->setTag(Filler::securityString($productBack->getTags()));

        $rate = $this->currencyBackRepository->getCurrentCourse();
        $price = $productBack->getPrice() * $rate['грн'];
        $metaTitle = Store::encodingConvert($productBack->getName());
        $metaTitle = "{$metaTitle} купить за {$price} грн: {$metaTitle} по низкой цене в Киеве с доставкой по Украине. "
            . "{$metaTitle}: цена, отзывы, описание, характеристики.";
        $productDescriptionFront->setMetaTitle($metaTitle);
        $productDescriptionFront->setMetaDescription(Filler::securityString($productBack->getMetaDescription()));
        $productDescriptionFront->setMetaKeyword(Filler::securityString($productBack->getMetaKeywords()));

        $this->productDescriptionFrontRepository->persistAndFlush($productDescriptionFront);

        $productLayoutFront = $this->productLayoutFrontRepository->find($productFrontId);
        if (null === $productLayoutFront) {
            $productLayoutFront = new ProductLayoutFront();
        }

        $productLayoutFront->setProductId($productFrontId);
        $productLayoutFront->setStoreId($this->storeFront->getDefaultStoreId());
        $productLayoutFront->setLayoutId($this->storeFront->getDefaultLayoutId());
        $this->productLayoutFrontRepository->persistAndFlush($productLayoutFront);

        $productStoreFront = $this->productStoreFrontRepository->find($productFrontId);
        if (null === $productStoreFront) {
            $productStoreFront = new ProductStoreFront();
        }

        $productStoreFront->setProductId($productFrontId);
        $productStoreFront->setStoreId($this->storeFront->getDefaultStoreId());

        $this->productStoreFrontRepository->persistAndFlush($productStoreFront);

        $categoryFrontId = $this->getCategoryFrontIdByBack($productBack->getCategoryId());
        $productCategoryFront = $this->productCategoryFrontRepository->find($productFrontId);
        if (null === $productCategoryFront) {
            $productCategoryFront = new ProductCategoryFront();
        }

        $productCategoryFront->setProductId($productFrontId);
        $productCategoryFront->setCategoryId($categoryFrontId);

        $this->productCategoryFrontRepository->persistAndFlush($productCategoryFront);

        $this->synchronizeAttributes($productBack, $productFrontId);

        $this->productDiscountBackToFrontSynchronizer->synchronizeByProductBackId($productBack->getProductId());

        if (true === $this->productDiscontinuedTableExists) {
            if (true === $productBack->getDiscontinued()) {
                $exists = $this->productDiscontinuedFrontRepository->exists($productFrontId);
                if (false === $exists) {
                    $productFrontDiscontinued = new ProductDiscontinuedFront();
                    $productFrontDiscontinued->setProductId($productFrontId);

                    $this->productDiscontinuedFrontRepository->persistAndFlush($productFrontDiscontinued);
                }
            } else {
                $this->productDiscontinuedFrontRepository->removeById($productFrontId);
            }
        }

        if (true === $this->seoUrlTableExists) {
            $seoUrl = $this->seoUrlFrontRepository->findOneByQueryAndLanguageId(
                "product_id={$productFrontId}",
                $this->storeFront->getDefaultLanguageId()
            );
            $this->synchronizeSeoUrl($seoUrl, $productFrontId, $productBack);
        }

        if (true === $this->synchronizeImage) {
            $this->synchronizeImage($productBack, $productFront);
        }

        return $productFront;
    }

    /**
     * @param int|null $categoryBackId
     * @return int
     */
    protected function getCategoryFrontIdByBack(?int $categoryBackId): int
    {
        if (null === $categoryBackId) {
            return $this->storeFront->getDefaultCategoryFrontId();
        }

        $category = $this->categoryRepository->findOneByBackId($categoryBackId);
        if (null === $category) {
            $message = "Category with backId {$categoryBackId} not found";
            $this->logger->error(ExceptionFormatter::f($message));

            return $this->storeFront->getDefaultCategoryFrontId();
        }

        $frontId = $category->getFrontId();
        if (null === $frontId) {
            $message = "Category front id is null";
            $this->logger->error(ExceptionFormatter::f($message));

            return $this->storeFront->getDefaultCategoryFrontId();
        }

        $categoryFront = $this->categoryFrontRepository->find($frontId);
        if (null === $categoryFront) {
            $message = "Category front is null";
            $this->logger->error(ExceptionFormatter::f($message));

            return $this->storeFront->getDefaultCategoryFrontId();
        }

        return $categoryFront->getCategoryId();
    }

    /**
     * @param ProductBack $productBack
     * @param int $productFrontId
     */
    protected function synchronizeAttributes(ProductBack $productBack, int $productFrontId)
    {
        $productAttributesBack = $this->attributeBackRepository->findAllByProductBackId($productBack->getProductId());
        foreach ($productAttributesBack as $productAttributeBack) {
            $attribute = $this->attributeRepository->findOneByBackId($productAttributeBack->getOptionId());
            if (null === $attribute) {
                continue;
            }
            $text = trim($productAttributeBack->getOptionValue());

            if (mb_strlen($text) > 0) {
                $exists = $this->productAttributeFrontRepository->existsByProductIdAttributeIdLanguageIdText(
                    $productFrontId,
                    $attribute->getFrontId(),
                    $this->storeFront->getDefaultLanguageId(),
                    $text
                );

                if (true === $exists) {
                    continue;
                }

                $productAttributeFront = new ProductAttributeFront();
                $productAttributeFront->setProductId($productFrontId);
                $productAttributeFront->setAttributeId($attribute->getFrontId());
                $productAttributeFront->setLanguageId($this->storeFront->getDefaultLanguageId());
                $productAttributeFront->setText($text);

                $this->productAttributeFrontRepository->persistAndFlush($productAttributeFront);
            }
        }
    }

    /**
     * @param SeoUrlFront|null $seoUrl
     * @param int $productFrontId
     * @param ProductBack $productBack
     */
    protected function synchronizeSeoUrl(?SeoUrlFront $seoUrl, int $productFrontId, ProductBack $productBack): void
    {
        if (null === $seoUrl) {
            $seoUrl = new SeoUrlFront();
        }

        $seoUrl->setStoreId($this->storeFront->getDefaultStoreId());
        $seoUrl->setLanguageId($this->storeFront->getDefaultLanguageId());
        $seoUrl->setQuery("product_id={$productFrontId}");

        $slug = trim(Filler::securityString($productBack->getSlug()));

        if (mb_strlen($slug) > 0) {
            $slugs = explode('/', $slug);
            if (count($slugs) > 1) {
                $seoUrl->setKeyword($slugs[1]);
            } else {
                $seoUrl->setKeyword($slug);
            }
        } else {
            $seoUrl->setKeyword(
                StoreFront::generateURL($productBack->getProductId(), Store::encodingConvert($productBack->getName()))
            );
        }

        $this->seoUrlFrontRepository->persistAndFlush($seoUrl);
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

        $this->productRepository->persistAndFlush($product);
    }

    /**
     * @param ProductBack $productBack
     * @param ProductFront $productFront
     */
    public function synchronizeImage(ProductBack $productBack, ProductFront $productFront): void
    {
        $productFront->setImage($this->defaultImagePath);
        $productBackImages = $this->productPicturesBackRepository->findByProductBackId($productBack->getProductId());
        foreach ($productBackImages as $key => $productBackImage) {
            $productFrontImage = $this->productImageSynchronizer->synchronizeProductImage(
                $productBackImage,
                $productFront,
                $key + 1
            );

            if (null === $productFrontImage) {
                continue;
            }

            if ($productFront->getImage() === $this->defaultImagePath) {
                $productFront->setImage($productFrontImage->getImage());
            }

            if ($productFront->getImage() === $productFrontImage->getImage()) {
                $this->productImageFrontRepository->remove($productFrontImage);
            }
        }

        $count = count($productBackImages) + 1;
        $photosBack = $this->photoBackRepository->findByProductBackId($productBack->getProductId());
        foreach ($photosBack as $key => $photoBack) {
            $productFrontImage = $this->productImageSynchronizer->synchronizePhoto(
                $photoBack,
                $productFront,
                $key + $count
            );

            if (null === $productFrontImage) {
                continue;
            }

            if ($productFront->getImage() === $this->defaultImagePath) {
                $productFront->setImage($productFrontImage->getImage());
            }

            if ($productFront->getImage() === $productFrontImage->getImage()) {
                $this->productImageFrontRepository->remove($productFrontImage);
            }
        }

        $this->productFrontRepository->persistAndFlush($productFront);
    }

    /**
     * @param string $productName
     * @return int
     */
    public function getManufacturerId(string $productName): int
    {
        $values = explode(' ', $productName);
        foreach ($values as $value) {
            $manufacturer = $this->manufacturerFrontRepository->findOneByName($value);
            if (null !== $manufacturer) {
                return $manufacturer->getManufacturerId();
            }
        }

        return $this->storeFront->getDefaultManufacturerId();
    }
}