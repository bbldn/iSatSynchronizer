<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Contract\BackToFront\DescriptionHelperContract;
use App\Contract\BackToFront\ManufacturerHelperContract;
use App\Contract\BackToFront\ProductSynchronizerHelperContract;
use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductCategory as ProductCategoryFront;
use App\Entity\Front\ProductDescription as ProductDescriptionFront;
use App\Entity\Front\ProductLayout as ProductLayoutFront;
use App\Entity\Front\ProductStore as ProductStoreFront;
use App\Entity\Product;
use App\Event\BackToFront\PriceSynchronizeAllFastEvent;
use App\Event\BackToFront\PriceSynchronizeEvent;
use App\Event\BackToFront\PriceSynchronizeFastEvent;
use App\Event\BackToFront\ProductsAllSynchronizedEvent;
use App\Event\BackToFront\ProductsClearEvent;
use App\Event\BackToFront\ProductsSynchronizedEvent;
use App\Event\BackToFront\ProductSynchronizedEvent;
use App\Helper\Back\Store as StoreBack;
use App\Helper\BackToFront\ProductSynchronizerHelper;
use App\Helper\Filler;
use App\Helper\Front\Store as StoreFront;
use App\Helper\Store;
use App\Repository\Back\CurrencyRepository as CurrencyBackRepository;
use App\Repository\Back\PhotoRepository as PhotoBackRepository;
use App\Repository\Back\ProductPicturesRepository as ProductPicturesBackRepository;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use App\Repository\CategoryRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use App\Repository\Front\ProductCategoryRepository as ProductCategoryFrontRepository;
use App\Repository\Front\ProductDescriptionRepository as ProductDescriptionFrontRepository;
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
use DateTime;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

abstract class ProductSynchronizer extends BackToFrontSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var EventDispatcherInterface $eventDispatcher */
    protected $eventDispatcher;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var StoreBack $storeBack */
    protected $storeBack;

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

    /** @var ProductDescriptionFrontRepository $productDescriptionFrontRepository */
    protected $productDescriptionFrontRepository;

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

    /** @var ProductBackRepository $productBackRepository */
    protected $productBackRepository;

    /** @var ProductPicturesBackRepository $productPicturesBackRepository */
    protected $productPicturesBackRepository;

    /** @var CurrencyBackRepository $currencyBackRepository */
    protected $currencyBackRepository;

    /** @var ProductSynchronizerHelper $productSynchronizerHelper */
    protected $productSynchronizerHelper;

    /** @var DescriptionHelperContract $descriptionHelper */
    protected $descriptionHelper;

    /** @var ManufacturerHelperContract $manufacturerHelper */
    protected $manufacturerHelper;

    /** @var bool $synchronizeImage */
    protected $synchronizeImage = false;

    /** @var array $events */
    protected $events = [
        ProductSynchronizedEvent::class => 0,
        ProductsAllSynchronizedEvent::class => 0,
        ProductsSynchronizedEvent::class => 0,
        ProductsClearEvent::class => 0,
        PriceSynchronizeEvent::class => 0,
        PriceSynchronizeFastEvent::class => 0,
        PriceSynchronizeAllFastEvent::class => 0,
    ];

    /** @var Product[] $synchronizedProducts */
    protected $synchronizedProducts = [];

    /**
     * ProductSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param EventDispatcherInterface $eventDispatcher
     * @param StoreFront $storeFront
     * @param StoreBack $storeBack
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     * @param CategoryFrontRepository $categoryFrontRepository
     * @param PhotoBackRepository $photoBackRepository
     * @param ProductFrontRepository $productFrontRepository
     * @param ProductDescriptionFrontRepository $productDescriptionFrontRepository
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
     * @param ProductBackRepository $productBackRepository
     * @param ProductPicturesBackRepository $productPicturesBackRepository
     * @param CurrencyBackRepository $currencyBackRepository
     * @param ProductSynchronizerHelperContract $productSynchronizerHelper
     * @param DescriptionHelperContract $descriptionHelper
     * @param ManufacturerHelperContract $manufacturerHelper
     */
    public function __construct(
        LoggerInterface $logger,
        EventDispatcherInterface $eventDispatcher,
        StoreFront $storeFront,
        StoreBack $storeBack,
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        CategoryFrontRepository $categoryFrontRepository,
        PhotoBackRepository $photoBackRepository,
        ProductFrontRepository $productFrontRepository,
        ProductDescriptionFrontRepository $productDescriptionFrontRepository,
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
        ProductBackRepository $productBackRepository,
        ProductPicturesBackRepository $productPicturesBackRepository,
        CurrencyBackRepository $currencyBackRepository,
        ProductSynchronizerHelperContract $productSynchronizerHelper,
        DescriptionHelperContract $descriptionHelper,
        ManufacturerHelperContract $manufacturerHelper
    )
    {
        $this->logger = $logger;
        $this->eventDispatcher = $eventDispatcher;
        $this->storeFront = $storeFront;
        $this->storeBack = $storeBack;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->categoryFrontRepository = $categoryFrontRepository;
        $this->photoBackRepository = $photoBackRepository;
        $this->productFrontRepository = $productFrontRepository;
        $this->productDescriptionFrontRepository = $productDescriptionFrontRepository;
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
        $this->productBackRepository = $productBackRepository;
        $this->productPicturesBackRepository = $productPicturesBackRepository;
        $this->currencyBackRepository = $currencyBackRepository;
        $this->productSynchronizerHelper = $productSynchronizerHelper;
        $this->descriptionHelper = $descriptionHelper;
        $this->manufacturerHelper = $manufacturerHelper;
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
        $this->updateProductFrontAndOtherFromProductBack($productBack, $productFront);
        $product = $this->createOrUpdateProduct($product, $productBack->getProductId(), $productFront->getProductId());

        if (1 === $this->events[ProductsSynchronizedEvent::class]) {
            $this->synchronizedProducts[] = $product;
        }

        if (1 === $this->events[ProductSynchronizedEvent::class]) {
            $this->eventDispatcher->dispatch(new ProductSynchronizedEvent($product, $this->synchronizeImage));
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

    /**
     * @param ProductBack $productBack
     * @param ProductFront $productFront
     * @return ProductFront
     */
    protected function updateProductFrontAndOtherFromProductBack(
        ProductBack $productBack,
        ProductFront $productFront
    ): ProductFront
    {
        $productFront = $this->updateProductFrontFromProductBack($productBack, $productFront);
        $this->updateProductDescriptionFrontFromProductBack($productBack, $productFront);
        $this->updateProductLayoutFrontFromProductBack($productFront);
        $this->updateProductStoreFrontFromProductBack($productFront);
        $this->updateProductCategoryFrontFromProductBack($productBack, $productFront);

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
        if (0.0 === $productBack->getPrice()) {
            $quantity = 0;
            $stockStatusId = $this->storeFront->getDefaultProductNotAvailableStatusId();
        } else {
            $quantity = 99999;
            $stockStatusId = $this->storeFront->getDefaultProductAvailableStatusId();
        }

        $productFront->setModel("art{$productBack->getProductId()}");
        $productFront->setSku($productBack->getProductId());
        $productFront->setUpc('');
        $productFront->setEan('');
        $productFront->setJan('');
        $productFront->setIsbn('');
        $productFront->setMpn('');
        $productFront->setLocation('');
        $productFront->setQuantity($quantity);
        $productFront->setStockStatusId($stockStatusId);
        $productName = Filler::securityString(Store::encodingConvert($productBack->getName()));
        if (null === $productFront->getManufacturerId()) {
            $productFront->setManufacturerId($this->manufacturerHelper->getManufacturerId($productName));
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

        $categoryFront = $this->productSynchronizerHelper->getCategoryFrontByCategoryBackId(
            $productBack->getCategoryId()
        );

        if (null !== $categoryFront) {
            $categoryStatus = $categoryFront->getStatus();
        } else {
            $categoryStatus = true;
        }

        $productFront->setStatus($productBack->getEnabled() !== 0 && $categoryStatus === true);

        if (null === $productFront->getViewed()) {
            $productFront->setViewed(0);
        }

        $this->productFrontRepository->persistAndFlush($productFront);

        return $productFront;
    }

    /**
     * @param ProductBack $productBack
     * @param ProductFront $productFront
     * @return ProductDescriptionFront
     */
    protected function updateProductDescriptionFrontFromProductBack(
        ProductBack $productBack,
        ProductFront $productFront
    ): ProductDescriptionFront
    {
        $productDescriptionFront = $this->productDescriptionFrontRepository->findOneByProductFrontIdAndLanguageId(
            $productFront->getProductId(),
            $this->storeFront->getDefaultLanguageId()
        );

        if (null === $productDescriptionFront) {
            $productDescriptionFront = new ProductDescriptionFront();
        }

        $productDescriptionFront->setProductId($productFront->getProductId());
        $productDescriptionFront->setLanguageId($this->storeFront->getDefaultLanguageId());
        $productDescriptionFront->setName(
            Filler::securityString(Store::encodingConvert($productBack->getName()))
        );

        if (true === $this->synchronizeImage) {
            $productDescriptionFront->setDescription(
                $this->descriptionHelper->synchronize(
                    trim(Store::encodingConvert($productBack->getDescription()))
                )
            );
        } else {
            if (null === $productDescriptionFront->getDescription()) {
                $productDescriptionFront->setDescription(trim(Store::encodingConvert($productBack->getDescription())));
            }
        }

        $productDescriptionFront->setTag(Filler::securityString($productBack->getTags()));

        if (null === $productDescriptionFront->getMetaTitle()) {
            $productDescriptionFront->setMetaTitle('');
        }

        if (null === $productDescriptionFront->getMetaDescription()) {
            $productDescriptionFront->setMetaDescription('');
        }

        $productDescriptionFront->setMetaKeyword(Filler::trim($productBack->getMetaKeywords()));

        $this->productDescriptionFrontRepository->persistAndFlush($productDescriptionFront);

        return $productDescriptionFront;
    }

    /**
     * @param ProductFront $productFront
     * @return ProductLayoutFront
     */
    protected function updateProductLayoutFrontFromProductBack(ProductFront $productFront): ProductLayoutFront
    {
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

        return $productLayoutFront;
    }

    /**
     * @param ProductFront $productFront
     * @return ProductStoreFront
     */
    protected function updateProductStoreFrontFromProductBack(ProductFront $productFront): ProductStoreFront
    {
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

        return $productStoreFront;
    }

    /**
     * @param ProductBack $productBack
     * @param ProductFront $productFront
     * @return ProductCategoryFront
     */
    protected function updateProductCategoryFrontFromProductBack(
        ProductBack $productBack,
        ProductFront $productFront
    ): ProductCategoryFront
    {
        $categoryFront = $this->productSynchronizerHelper->getCategoryFrontByCategoryBackId(
            $productBack->getCategoryId()
        );

        if (null !== $categoryFront) {
            $categoryFrontId = $categoryFront->getCategoryId();
        } else {
            $categoryFrontId = $this->storeFront->getDefaultCategoryFrontId();
        }

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

        return $productCategoryFront;
    }

    /**
     * @param Product $product
     * @param int $backId
     * @param int $frontId
     * @return Product
     */
    protected function createOrUpdateProduct(?Product $product, int $backId, int $frontId): Product
    {
        if (null === $product) {
            $product = new Product();
        }

        $product->setBackId($backId);
        $product->setFrontId($frontId);

        $this->productRepository->persistAndFlush($product);

        return $product;
    }
}