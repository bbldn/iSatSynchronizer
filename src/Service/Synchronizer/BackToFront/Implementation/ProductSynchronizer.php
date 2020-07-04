<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Category as CategoryFront;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductAttribute as ProductAttributeFront;
use App\Entity\Front\ProductCategory as ProductCategoryFront;
use App\Entity\Front\ProductDescription as ProductDescriptionFront;
use App\Entity\Front\ProductDiscontinued as ProductDiscontinuedFront;
use App\Entity\Front\ProductLayout as ProductLayoutFront;
use App\Entity\Front\ProductStore as ProductStoreFront;
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
use App\Repository\ProductRepository;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;
use App\Service\Synchronizer\BackToFront\DescriptionSynchronizer;
use App\Service\Synchronizer\BackToFront\ProductDiscountSpeedSynchronizer as ProductDiscountBackToFrontSynchronizer;
use App\Service\Synchronizer\BackToFront\ProductSeoUrlSynchronizer as ProductSeoUrlBackToFrontSynchronizer;
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

    /** @var ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository */
    protected $productDiscontinuedFrontRepository;

    /** @var CurrencyBackRepository $currencyBackRepository */
    protected $currencyBackRepository;

    /** @var ProductDiscountBackToFrontSynchronizer $productDiscountBackToFrontSynchronizer */
    protected $productDiscountBackToFrontSynchronizer;

    /** @var ProductSeoUrlBackToFrontSynchronizer $productSeoUrlBackToFrontSynchronizer */
    protected $productSeoUrlBackToFrontSynchronizer;

    /** @var DescriptionSynchronizer $descriptionSynchronizer */
    protected $descriptionSynchronizer;

    /** @var ManufacturerSynchronizer $manufacturerSynchronizer */
    protected $manufacturerSynchronizer;

    /** @var string $defaultImagePath */
    protected $defaultImagePath = null;

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
     * @param ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository
     * @param CurrencyBackRepository $currencyBackRepository
     * @param ProductSeoUrlBackToFrontSynchronizer $productSeoUrlBackToFrontSynchronizer
     * @param ProductDiscountBackToFrontSynchronizer $productDiscountBackToFrontSynchronizer
     * @param DescriptionSynchronizer $descriptionSynchronizer
     * @param ManufacturerSynchronizer $manufacturerSynchronizer
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
        ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository,
        CurrencyBackRepository $currencyBackRepository,
        ProductSeoUrlBackToFrontSynchronizer $productSeoUrlBackToFrontSynchronizer,
        ProductDiscountBackToFrontSynchronizer $productDiscountBackToFrontSynchronizer,
        DescriptionSynchronizer $descriptionSynchronizer,
        ManufacturerSynchronizer $manufacturerSynchronizer
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
        $this->productImageSynchronizer = $productImageSynchronizer;
        $this->productDiscontinuedFrontRepository = $productDiscontinuedFrontRepository;
        $this->currencyBackRepository = $currencyBackRepository;
        $this->productSeoUrlBackToFrontSynchronizer = $productSeoUrlBackToFrontSynchronizer;
        $this->productDiscountBackToFrontSynchronizer = $productDiscountBackToFrontSynchronizer;
        $this->descriptionSynchronizer = $descriptionSynchronizer;
        $this->manufacturerSynchronizer = $manufacturerSynchronizer;
    }

    /**
     * @param bool $clearImage
     */
    protected function clear(bool $clearImage = false): void
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

        $this->productSeoUrlBackToFrontSynchronizer->clearRemove();

        if (true === $this->synchronizeImage) {
            $this->productImageSynchronizer->clearFolder();
            $this->descriptionSynchronizer->clearFolder();
        }
    }

    /**
     *
     */
    protected function _load(): void
    {
        $this->productDiscontinuedTableExists = $this->productDiscontinuedFrontRepository->tableExists();
        $this->productSeoUrlBackToFrontSynchronizer->load();
    }

    /**
     * @param ProductBack $productBack
     * @param bool $synchronizeImage
     */
    protected function synchronizeProduct(ProductBack $productBack, bool $synchronizeImage = false): void
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
        $this->productDiscountBackToFrontSynchronizer->synchronizeByProductBackId($productBack->getProductId());
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
        $stockAvailableStatusId = $this->storeFront->getDefaultProductAvailableStatusId();

        $productFront->setModel('art' . $productBack->getProductId());
        $productFront->setSku($productBack->getProductId());
        $productFront->setUpc(Filler::securityString(null));
        $productFront->setEan(Filler::securityString(null));
        $productFront->setJan(Filler::securityString(null));
        $productFront->setIsbn(Filler::securityString(null));
        $productFront->setMpn(Filler::securityString(null));
        $productFront->setLocation(Filler::securityString(null));
        $productFront->setQuantity(999999);
        $productFront->setStockStatusId($stockAvailableStatusId);
        $productName = Filler::securityString(Store::encodingConvert($productBack->getName()));
        if (null === $productFront->getManufacturerId()) {
            $productFront->setManufacturerId($this->manufacturerSynchronizer->getManufacturerId($productName));
        }
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

        $categoryFront = $this->getCategoryFrontByCategoryBackId($productBack->getCategoryId());
        if (null !== $categoryFront) {
            $categoryFrontId = $categoryFront->getCategoryId();
            $categoryStatus = $categoryFront->getStatus();
        } else {
            $categoryFrontId = $this->storeFront->getDefaultCategoryFrontId();
            $categoryStatus = true;
        }

        $productFront->setStatus($productBack->getEnabled() !== 0 && $categoryStatus === true);

        if (null === $productFront->getViewed()) {
            $productFront->setViewed(0);
        }

        $this->productFrontRepository->persistAndFlush($productFront);

        $productDescriptionFront = $this->productDescriptionFrontRepository->findOneByProductFrontIdAndLanguageId(
            $productFront->getProductId(),
            $this->storeFront->getDefaultLanguageId()
        );

        if (null === $productDescriptionFront) {
            $productDescriptionFront = new ProductDescriptionFront();
        }

        $productDescriptionFront->setProductId($productFront->getProductId());
        $productDescriptionFront->setLanguageId($this->storeFront->getDefaultLanguageId());
        $productDescriptionFront->setName($productName);

        if (true === $this->synchronizeImage) {
            $productDescriptionFront->setDescription(
                $this->descriptionSynchronizer->synchronize(
                    trim(Store::encodingConvert($productBack->getDescription()))
                )
            );
        } else {
            $productDescriptionFront->setDescription(trim(Store::encodingConvert($productBack->getDescription())));
        }

        $productDescriptionFront->setTag(Filler::securityString($productBack->getTags()));
        $productDescriptionFront->setMetaTitle($productName);
        $productDescriptionFront->setMetaDescription(Filler::securityString($productBack->getMetaDescription()));
        $productDescriptionFront->setMetaKeyword(Filler::securityString($productBack->getMetaKeywords()));

        $this->productDescriptionFrontRepository->persistAndFlush($productDescriptionFront);

        $productLayoutFront = $this->productLayoutFrontRepository->findOneByProductFrontIdAndStoreId(
            $productFront->getProductId(),
            $this->storeFront->getDefaultStoreId()
        );

        if (null === $productLayoutFront) {
            $productLayoutFront = new ProductLayoutFront();
        }

        $productLayoutFront->setProductId($productFront->getProductId());
        $productLayoutFront->setStoreId($this->storeFront->getDefaultStoreId());
        $productLayoutFront->setLayoutId($this->storeFront->getDefaultProductLayoutId());

        $this->productLayoutFrontRepository->persistAndFlush($productLayoutFront);

        $productStoreFront = $this->productStoreFrontRepository->findOneByProductFrontIdAndStoreId(
            $productFront->getProductId(),
            $this->storeFront->getDefaultStoreId()
        );

        if (null === $productStoreFront) {
            $productStoreFront = new ProductStoreFront();
        }

        $productStoreFront->setProductId($productFront->getProductId());
        $productStoreFront->setStoreId($this->storeFront->getDefaultStoreId());

        $this->productStoreFrontRepository->persistAndFlush($productStoreFront);

        $productCategoryFront = $this->productCategoryFrontRepository->findOneByProductFrontIdAndCategoryId(
            $productFront->getProductId(),
            $categoryFrontId
        );

        if (null === $productCategoryFront) {
            $productCategoryFront = new ProductCategoryFront();
        }

        $productCategoryFront->setProductId($productFront->getProductId());
        $productCategoryFront->setCategoryId($categoryFrontId);

        $this->productCategoryFrontRepository->persistAndFlush($productCategoryFront);

        $this->synchronizeAttributes($productBack, $productFront->getProductId());
        $this->synchronizeDiscount($productBack);

        if (true === $this->productDiscontinuedTableExists) {
            if (true === $productBack->getDiscontinued()) {
                $exists = $this->productDiscontinuedFrontRepository->exists($productFront->getProductId());
                if (false === $exists) {
                    $productFrontDiscontinued = new ProductDiscontinuedFront();
                    $productFrontDiscontinued->setProductId($productFront->getProductId());

                    $this->productDiscontinuedFrontRepository->persistAndFlush($productFrontDiscontinued);
                }
            } else {
                $this->productDiscontinuedFrontRepository->removeById($productFront->getProductId());
            }
        }

        $this->productSeoUrlBackToFrontSynchronizer->synchronizeByProductBackAndProductFront(
            $productBack,
            $productFront
        );


        if (true === $this->synchronizeImage) {
            $this->synchronizeImage($productBack, $productFront);
        }

        return $productFront;
    }

    /**
     * @param ProductBack $productBack
     */
    protected function synchronizeDiscount(ProductBack $productBack): void
    {
        $this->productDiscountBackToFrontSynchronizer->createOrUpdateDiscountItems($productBack->getProductId());
        $this->productDiscountBackToFrontSynchronizer->synchronizeByProductBackId($productBack->getProductId());
    }

    /**
     * @param int|null $categoryBackId
     * @return CategoryFront|null
     */
    protected function getCategoryFrontByCategoryBackId(?int $categoryBackId): ?CategoryFront
    {
        if (null === $categoryBackId) {
            return null;
        }

        $category = $this->categoryRepository->findOneByBackId($categoryBackId);
        if (null === $category) {
            $message = "Category with backId {$categoryBackId} not found";
            $this->logger->error(ExceptionFormatter::f($message));

            return null;
        }

        $frontId = $category->getFrontId();
        if (null === $frontId) {
            $message = "Category front id is null";
            $this->logger->error(ExceptionFormatter::f($message));

            return null;
        }

        $categoryFront = $this->categoryFrontRepository->find($frontId);

        if (null === $categoryFront) {
            $message = "Category description front is null";
            $this->logger->error(ExceptionFormatter::f($message));

            return null;
        }

        return $categoryFront;
    }

    /**
     * @param ProductBack $productBack
     * @param int $productFrontId
     */
    protected function synchronizeAttributes(ProductBack $productBack, int $productFrontId): void
    {
        $productAttributesBack = $this->attributeBackRepository->findAllByProductBackId($productBack->getProductId());
        foreach ($productAttributesBack as $productAttributeBack) {
            $attribute = $this->attributeRepository->findOneByBackId($productAttributeBack->getOptionId());
            if (null === $attribute) {
                continue;
            }

            $productAttributeFront = $this->productAttributeFrontRepository->findOneByProductIdAttributeIdLanguageId(
                $productFrontId,
                $attribute->getFrontId(),
                $this->storeFront->getDefaultLanguageId()
            );

            if (null === $productAttributeFront) {
                $productAttributeFront = new ProductAttributeFront();
            }

            $productAttributeFront->setProductId($productFrontId);
            $productAttributeFront->setAttributeId($attribute->getFrontId());
            $productAttributeFront->setLanguageId($this->storeFront->getDefaultLanguageId());
            $productAttributeFront->setText(
                trim($productAttributeBack->getOptionValue())
            );

            $this->productAttributeFrontRepository->persistAndFlush($productAttributeFront);
        }
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
     *
     */
    protected function updatePriceAll(): void
    {
        $products = $this->productBackRepository->getPricesAll();
        $this->productFrontRepository->updatePriceByData($products);
        foreach ($products as $value) {
            $this->productDiscountBackToFrontSynchronizer->synchronizeByProductBackId($value['product_id']);
        }
    }

    /**
     *
     */
    protected function updatePriceAllFast(): void
    {
        $products = $this->productBackRepository->getPricesAll();
        $this->productFrontRepository->updatePriceByData($products);
        $this->productDiscountBackToFrontSynchronizer->synchronizeAll();
    }

    /**
     * @param string $ids
     */
    protected function updatePriceByIds(string $ids): void
    {
        $products = $this->productBackRepository->getPricesByIds($ids);
        $this->productFrontRepository->updatePriceByData($products);
        foreach ($products as $value) {
            $this->productDiscountBackToFrontSynchronizer->synchronizeByProductBackId($value['product_id']);
        }
    }

    /**
     * @param string $ids
     */
    protected function updatePriceByIdsFast(string $ids): void
    {
        $products = $this->productBackRepository->getPricesByIds($ids);
        $this->productFrontRepository->updatePriceByData($products);
        $this->productDiscountBackToFrontSynchronizer->synchronizeByIds($ids);
    }

    /**
     * @param string $ids
     */
    protected function updatePriceByCategoryIds(string $ids): void
    {
        $products = $this->productBackRepository->getBackPricesByCategoryIds($ids);
        $this->productFrontRepository->updatePriceByData($products);
        foreach ($products as $value) {
            $this->productDiscountBackToFrontSynchronizer->synchronizeByProductBackId($value['product_id']);
        }
    }
}