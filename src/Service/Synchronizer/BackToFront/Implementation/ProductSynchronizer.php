<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Category as CategoryFront;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductCategory as ProductCategoryFront;
use App\Entity\Front\ProductDescription as ProductDescriptionFront;
use App\Entity\Front\ProductDiscontinued as ProductDiscontinuedFront;
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
use App\Helper\ExceptionFormatter;
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
use App\Repository\Front\ProductDiscontinuedRepository as ProductDiscontinuedFrontRepository;
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
use DateTime;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class ProductSynchronizer extends BackToFrontSynchronizer
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

    /** @var ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository */
    protected $productDiscontinuedFrontRepository;

    /** @var CurrencyBackRepository $currencyBackRepository */
    protected $currencyBackRepository;

    /** @var DescriptionSynchronizer $descriptionSynchronizer */
    protected $descriptionSynchronizer;

    /** @var ManufacturerSynchronizer $manufacturerSynchronizer */
    protected $manufacturerSynchronizer;

    /** @var bool $seoUrlTableExists */
    protected $productDiscontinuedTableExists = false;

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
     * @param ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository
     * @param CurrencyBackRepository $currencyBackRepository
     * @param DescriptionSynchronizer $descriptionSynchronizer
     * @param ManufacturerSynchronizer $manufacturerSynchronizer
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
        ProductDiscontinuedFrontRepository $productDiscontinuedFrontRepository,
        CurrencyBackRepository $currencyBackRepository,
        DescriptionSynchronizer $descriptionSynchronizer,
        ManufacturerSynchronizer $manufacturerSynchronizer
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
        $this->productDiscontinuedFrontRepository = $productDiscontinuedFrontRepository;
        $this->currencyBackRepository = $currencyBackRepository;
        $this->descriptionSynchronizer = $descriptionSynchronizer;
        $this->manufacturerSynchronizer = $manufacturerSynchronizer;
    }

    /**
     * @param bool $clearImage
     */
    protected function clear(bool $clearImage = false): void
    {
        $this->synchronizeImage = $clearImage;
        $this->events[ProductsClearEvent::class] = 1;

        $this->productRepository->removeAll();
        $this->productFrontRepository->removeAll();
        $this->productDescriptionFrontRepository->removeAll();
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
        $this->productImageFrontRepository->resetAutoIncrements();
        $this->productOptionFrontRepository->resetAutoIncrements();
        $this->productOptionValueFrontRepository->resetAutoIncrements();
        $this->productRewardFrontRepository->resetAutoIncrements();
        $this->productSpecialFrontRepository->resetAutoIncrements();

        if (true === $this->productDiscontinuedTableExists) {
            $this->productDiscontinuedFrontRepository->removeAll();
            $this->productDiscontinuedFrontRepository->resetAutoIncrements();
        }

        if (true === $this->synchronizeImage) {
            $this->descriptionSynchronizer->clearFolder();
        }

        if (1 === $this->events[ProductsClearEvent::class]) {
            $this->eventDispatcher->dispatch(new ProductsClearEvent());
        }
    }

    /**
     *
     */
    protected function _load(): void
    {
        $this->productDiscontinuedTableExists = $this->productDiscontinuedFrontRepository->tableExists();
        $this->descriptionSynchronizer->load();
        $this->manufacturerSynchronizer->load();
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

        return $productFront;
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

    /**
     * @param int $id
     * @param bool $synchronizeImage
     */
    protected function synchronizeByCategoryId(int $id, bool $synchronizeImage = false): void
    {
        $this->events[ProductsSynchronizedEvent::class] = 1;

        $productsBack = $this->productBackRepository->findByCategoryId($id);
        foreach ($productsBack as $productBack) {
            $this->synchronizeProduct($productBack, $synchronizeImage);
        }

        if (1 === $this->events[ProductSynchronizedEvent::class]) {
            $this->eventDispatcher->dispatch(new ProductsSynchronizedEvent($this->synchronizedProducts));
        }
    }

    /**
     * @param string $ids
     * @param bool $synchronizeImage
     */
    protected function synchronizeByIds(string $ids, bool $synchronizeImage = false): void
    {
        $this->events[ProductSynchronizedEvent::class] = 1;
        $this->events[ProductsSynchronizedEvent::class] = 1;

        $productsBack = $this->productBackRepository->findByIds($ids);
        foreach ($productsBack as $productBack) {
            $this->synchronizeProduct($productBack, $synchronizeImage);
        }

        if (1 === $this->events[ProductsSynchronizedEvent::class]) {
            $this->eventDispatcher->dispatch(new ProductsSynchronizedEvent($this->synchronizedProducts));
        }
    }

    /**
     * @param string $name
     * @param bool $synchronizeImage
     */
    protected function synchronizeByName(string $name, bool $synchronizeImage = false): void
    {
        $this->events[ProductSynchronizedEvent::class] = 1;
        $this->events[ProductsSynchronizedEvent::class] = 1;

        $productsBack = $this->productBackRepository->findByName($name);
        foreach ($productsBack as $productBack) {
            $this->synchronizeProduct($productBack, $synchronizeImage);
        }

        if (1 === $this->events[ProductsSynchronizedEvent::class]) {
            $this->eventDispatcher->dispatch(new ProductsSynchronizedEvent($this->synchronizedProducts));
        }
    }

    /**
     * @param bool $synchronizeImage
     */
    protected function synchronizeAll(bool $synchronizeImage = false): void
    {
        $this->events[ProductSynchronizedEvent::class] = 1;
        $this->events[ProductsAllSynchronizedEvent::class] = 1;

        $productsBack = $this->productBackRepository->findAll();
        foreach ($productsBack as $productBack) {
            $this->synchronizeProduct($productBack, $synchronizeImage);
        }

        if (1 === $this->events[ProductsAllSynchronizedEvent::class]) {
            $this->eventDispatcher->dispatch(new ProductsAllSynchronizedEvent());
        }
    }

    /**
     *
     */
    protected function synchronizePriceAll(): void
    {
        $this->events[PriceSynchronizeEvent::class] = 1;

        $products = $this->productBackRepository->getPricesAll();
        $this->productFrontRepository->updatePriceByData($products);

        if (1 === $this->events[PriceSynchronizeEvent::class]) {
            $this->eventDispatcher->dispatch(new PriceSynchronizeEvent($products));
        }
    }

    /**
     *
     */
    protected function synchronizePriceAllFast(): void
    {
        $this->events[PriceSynchronizeAllFastEvent::class] = 1;

        $products = $this->productBackRepository->getPricesAll();
        $this->productFrontRepository->updatePriceByData($products);

        if (1 === $this->events[PriceSynchronizeAllFastEvent::class]) {
            $this->eventDispatcher->dispatch(new PriceSynchronizeAllFastEvent());
        }
    }

    /**
     * @param string $ids
     */
    protected function synchronizePriceByIds(string $ids): void
    {
        $this->events[PriceSynchronizeEvent::class] = 1;

        $products = $this->productBackRepository->getPricesByIds($ids);
        $this->productFrontRepository->updatePriceByData($products);

        if (1 === $this->events[PriceSynchronizeEvent::class]) {
            $this->eventDispatcher->dispatch(new PriceSynchronizeEvent($products));
        }
    }

    /**
     * @param string $ids
     */
    protected function synchronizePriceByIdsFast(string $ids): void
    {
        $this->events[PriceSynchronizeFastEvent::class] = 1;

        $products = $this->productBackRepository->getPricesByIds($ids);
        $this->productFrontRepository->updatePriceByData($products);

        if (1 === $this->events[PriceSynchronizeFastEvent::class]) {
            $this->eventDispatcher->dispatch(new PriceSynchronizeFastEvent($ids));
        }
    }

    /**
     * @param string $ids
     */
    protected function synchronizePriceByCategoryIds(string $ids): void
    {
        $this->events[PriceSynchronizeEvent::class] = 1;

        $products = $this->productBackRepository->getPricesByCategoryIds($ids);
        $this->productFrontRepository->updatePriceByData($products);

        if (1 === $this->events[PriceSynchronizeEvent::class]) {
            $this->eventDispatcher->dispatch(new PriceSynchronizeEvent($products));
        }
    }
}