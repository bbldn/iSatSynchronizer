<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\BuyersGroupsPrices as ProductDiscountBack;
use App\Entity\Front\ProductDiscount as ProductDiscountFront;
use App\Helper\ExceptionFormatter;
use App\Helper\Front\Store as StoreFront;
use App\Repository\Back\BuyersGroupsPricesRepository as ProductDiscountBackRepository;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use App\Repository\Front\CustomerGroupRepository as CustomerGroupFrontRepository;
use App\Repository\Front\ProductDiscountRepository as ProductDiscountFrontRepository;
use App\Repository\ProductRepository;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;
use DateTime;
use Psr\Log\LoggerInterface;

class ProductDiscountSynchronizer extends BackToFrontSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var ProductBackRepository $productBackRepository */
    protected $productBackRepository;

    /** @var ProductDiscountFrontRepository $productDiscountFrontRepository */
    protected $productDiscountFrontRepository;

    /** @var ProductRepository $productRepository */
    protected $productRepository;

    /** @var ProductDiscountBackRepository */
    protected $productDiscountBackRepository;

    /** @var CustomerGroupFrontRepository $customerGroupRepository */
    protected $customerGroupRepository;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /**
     * ProductDiscountSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param ProductBackRepository $productBackRepository
     * @param ProductDiscountFrontRepository $productDiscountFrontRepository
     * @param ProductRepository $productRepository
     * @param ProductDiscountBackRepository $productDiscountBackRepository
     * @param CustomerGroupFrontRepository $customerGroupRepository
     * @param StoreFront $storeFront
     */
    public function __construct(
        LoggerInterface $logger,
        ProductBackRepository $productBackRepository,
        ProductDiscountFrontRepository $productDiscountFrontRepository,
        ProductRepository $productRepository,
        ProductDiscountBackRepository $productDiscountBackRepository,
        CustomerGroupFrontRepository $customerGroupRepository,
        StoreFront $storeFront
    )
    {
        $this->logger = $logger;
        $this->productBackRepository = $productBackRepository;
        $this->productDiscountFrontRepository = $productDiscountFrontRepository;
        $this->productRepository = $productRepository;
        $this->productDiscountBackRepository = $productDiscountBackRepository;
        $this->customerGroupRepository = $customerGroupRepository;
        $this->storeFront = $storeFront;
    }

    /**
     *
     */
    protected function synchronizeAll(): void
    {
        $productDiscountsBack = $this->productDiscountBackRepository->findAll();
        foreach ($productDiscountsBack as $productDiscountBack) {
            $this->synchronizeProductDiscount($productDiscountBack);
        }
    }

    /**
     * @param int $productBackId
     */
    protected function synchronizeByProductBackId(int $productBackId): void
    {
        $productDiscountsBack = $this->productDiscountBackRepository->findByProductBackId($productBackId);
        $productDiscountBack = $this->getProductDiscountBack($productBackId);

        if (null !== $productDiscountBack) {
            $productDiscountsBack[] = $productDiscountBack;
        }

        foreach ($productDiscountsBack as $productDiscountBack) {
            $this->synchronizeProductDiscount($productDiscountBack);
        }
    }

    /**
     * @param ProductDiscountBack $productDiscountBack
     */
    protected function synchronizeProductDiscount(ProductDiscountBack $productDiscountBack): void
    {
        $productDiscountFront = $this->getProductDiscountFrontFromProductDiscountBack($productDiscountBack);
        $this->updateCategoryFrontFromCategoryBack($productDiscountBack, $productDiscountFront);
    }

    /**
     * @param ProductDiscountBack $productDiscountBack
     * @return ProductDiscountFront|null
     */
    protected function getProductDiscountFrontFromProductDiscountBack(
        ProductDiscountBack $productDiscountBack
    ): ?ProductDiscountFront
    {
        $product = $this->productRepository->findOneByBackId($productDiscountBack->getProductId());
        if (null === $product) {
            return new ProductDiscountFront();
        }

        $productDiscountFront = $this->productDiscountFrontRepository->findOneByCustomerGroupIdAndProductId(
            $productDiscountBack->getGroupId(),
            $product->getFrontId()
        );

        if (null === $productDiscountFront) {
            return new ProductDiscountFront();
        }

        return $productDiscountFront;
    }

    /**
     * @param ProductDiscountBack $productDiscountBack
     * @param ProductDiscountFront $productDiscountFront
     * @return ProductDiscountFront
     */
    protected function updateCategoryFrontFromCategoryBack(
        ProductDiscountBack $productDiscountBack,
        ProductDiscountFront $productDiscountFront
    ): ProductDiscountFront
    {
        $product = $this->productRepository->findOneByBackId($productDiscountBack->getProductId());
        if (null === $product || null === $product->getFrontId()) {
            $error = "ProductBack with id: {$productDiscountBack->getProductId()} not synchronized";
            $this->logger->error(ExceptionFormatter::f($error));

            return $productDiscountFront;
        }

        $this->createProductDiscountFront(
            $productDiscountFront,
            $product->getFrontId(),
            $productDiscountBack->getGroupId(),
            $productDiscountBack->getPrice()
        );

        $this->productDiscountFrontRepository->persistAndFlush($productDiscountFront);

        return $productDiscountFront;
    }

    /**
     * @param int $productBackId
     * @return ProductDiscountBack|null
     */
    protected function getProductDiscountBack(int $productBackId): ?ProductDiscountBack
    {
        $productBack = $this->productBackRepository->find($productBackId);
        if (null === $productBack) {
            return null;
        }

        $productDiscountBack = new ProductDiscountBack();
        $productDiscountBack->setPrice($productBack->getPrice());
        $productDiscountBack->setGroupId(1);
        $productDiscountBack->setProductId($productBack->getProductId());

        return $productDiscountBack;
    }

    /**
     * @param ProductDiscountFront $productDiscountFront
     * @param int $productId
     * @param int $customerGroupId
     * @param float $price
     * @return ProductDiscountFront
     */
    protected function createProductDiscountFront(
        ProductDiscountFront $productDiscountFront,
        int $productId,
        int $customerGroupId,
        float $price
    ): ProductDiscountFront
    {
        $productDiscountFront->setProductId($productId);
        $productDiscountFront->setCustomerGroupId($customerGroupId);
        $productDiscountFront->setQuantity($this->storeFront->getDefaultQuantity());
        $productDiscountFront->setPriority($this->storeFront->getDefaultPriority());
        $productDiscountFront->setPrice($price);
        $productDiscountFront->setDateStart(new DateTime('0000-00-00 00:00:00'));
        $productDiscountFront->setDateEnd(new DateTime('0000-00-00 00:00:00'));

        return $productDiscountFront;
    }

    /**
     * @param int $productId
     */
    protected function createOrUpdateDiscountItems(int $productId): void
    {
        $customersGroupFront = $this->customerGroupRepository->findAll();
        foreach ($customersGroupFront as $customerGroupFront) {
            $productDiscountFront = $this->productDiscountFrontRepository->findOneByCustomerGroupIdAndProductId(
                $customerGroupFront->getCustomerGroupId(),
                $productId
            );

            if (null !== $productDiscountFront) {
                continue;
            }

            $productDiscountFront = $this->createProductDiscountFront(
                new ProductDiscountFront(),
                $productId,
                $customerGroupFront->getCustomerGroupId(),
                0
            );

            $this->productDiscountFrontRepository->persistAndFlush($productDiscountFront);
        }
    }

    /**
     *
     */
    protected function clear(): void
    {
        $this->productDiscountFrontRepository->clear();
        $this->productDiscountFrontRepository->resetAutoIncrements();
    }
}