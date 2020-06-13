<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\BuyersGroupsPrices as ProductDiscountBack;
use App\Entity\Front\ProductDiscount as ProductDiscountFront;
use App\Helper\ExceptionFormatter;
use App\Helper\Front\Store as StoreFront;
use App\Repository\Back\BuyersGroupsPricesRepository as ProductDiscountBackRepository;
use App\Repository\Front\ProductDiscountRepository as ProductDiscountFrontRepository;
use App\Repository\Back\ProductRepository as ProductBackRepository;
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

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /**
     * ProductDiscountSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param ProductBackRepository $productBackRepository
     * @param ProductDiscountFrontRepository $productDiscountFrontRepository
     * @param ProductRepository $productRepository
     * @param ProductDiscountBackRepository $productDiscountBackRepository
     * @param StoreFront $storeFront
     */
    public function __construct(
        LoggerInterface $logger,
        ProductBackRepository $productBackRepository,
        ProductDiscountFrontRepository $productDiscountFrontRepository,
        ProductRepository $productRepository,
        ProductDiscountBackRepository $productDiscountBackRepository,
        StoreFront $storeFront
    )
    {
        $this->logger = $logger;
        $this->productBackRepository = $productBackRepository;
        $this->productDiscountFrontRepository = $productDiscountFrontRepository;
        $this->productRepository = $productRepository;
        $this->productDiscountBackRepository = $productDiscountBackRepository;
        $this->storeFront = $storeFront;
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

        $productDiscountFront->setProductId($product->getFrontId());
        $productDiscountFront->setCustomerGroupId($productDiscountBack->getGroupId());
        $productDiscountFront->setQuantity($this->storeFront->getDefaultQuantity());
        $productDiscountFront->setPriority($this->storeFront->getDefaultPriority());
        $productDiscountFront->setPrice($productDiscountBack->getPrice());
        $productDiscountFront->setDateStart(new DateTime('0000-00-00 00:00:00'));
        $productDiscountFront->setDateEnd(new DateTime('0000-00-00 00:00:00'));

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
}