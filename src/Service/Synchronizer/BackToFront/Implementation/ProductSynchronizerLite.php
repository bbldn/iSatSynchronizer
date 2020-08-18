<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Product;
use App\Event\BackToFront\ProductSynchronizedLiteEvent;
use App\Exception\ProductBackNotFoundException;
use App\Exception\ProductFrontNotFoundException;
use App\Helper\BackToFront\ProductSynchronizerHelper;
use App\Helper\ExceptionFormatter;
use App\Repository\Front\ProductRepository as ProductFrontRepository;
use App\Repository\ProductRepository;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class ProductSynchronizerLite extends BackToFrontSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var EventDispatcherInterface $eventDispatcher */
    protected $eventDispatcher;

    /** @var ProductRepository $productRepository */
    protected $productRepository;

    /** @var ProductFrontRepository $productFrontRepository */
    protected $productFrontRepository;

    /** @var ProductSynchronizerHelper $productSynchronizerHelper */
    protected $productSynchronizerHelper;

    /**
     * ProductSynchronizerLite constructor.
     * @param LoggerInterface $logger
     * @param EventDispatcherInterface $eventDispatcher
     * @param ProductRepository $productRepository
     * @param ProductFrontRepository $productFrontRepository
     * @param ProductSynchronizerHelper $productSynchronizerHelper
     */
    public function __construct(
        LoggerInterface $logger,
        EventDispatcherInterface $eventDispatcher,
        ProductRepository $productRepository,
        ProductFrontRepository $productFrontRepository,
        ProductSynchronizerHelper $productSynchronizerHelper
    )
    {
        $this->logger = $logger;
        $this->eventDispatcher = $eventDispatcher;
        $this->productRepository = $productRepository;
        $this->productFrontRepository = $productFrontRepository;
        $this->productSynchronizerHelper = $productSynchronizerHelper;
    }

    /**
     * @param ProductBack $productBack
     * @return Product
     * @throws ProductBackNotFoundException
     */
    protected function getProductFromProductBack(ProductBack $productBack): Product
    {
        $product = $this->productRepository->findOneByBackId($productBack->getProductId());
        if (null === $product) {
            $message = "Synchronization lite is not possible. " .
                "Because the product back with id {$productBack->getProductId()} is not sync";

            throw new ProductBackNotFoundException($message);
        }

        return $product;
    }

    /**
     * @param Product $product
     * @return ProductFront
     * @throws ProductFrontNotFoundException
     */
    protected function getProductFrontFromProduct(Product $product): ProductFront
    {
        $productFront = $this->productFrontRepository->find($product->getFrontId());
        if (null === $productFront) {
            $message = "Synchronization lite is not possible. " .
                "Because the product front with id {$product->getFrontId()} is not sync";

            throw new ProductFrontNotFoundException($message);
        }

        return $productFront;
    }

    /**
     * @param ProductBack $productBack
     * @param ProductFront $productFront
     */
    protected function updateProductFrontFromProductBackLite(
        ProductBack $productBack,
        ProductFront $productFront
    ): void
    {
        $productFront->setPrice($productBack->getPrice());

        $categoryFront = $this->productSynchronizerHelper->getCategoryFrontByCategoryBackId(
            $productBack->getCategoryId()
        );

        if (null !== $categoryFront) {
            $categoryStatus = $categoryFront->getStatus();
        } else {
            $categoryStatus = true;
        }

        $productFront->setSortOrder($productBack->getSortOrder());
        $productFront->setStatus($productBack->getEnabled() !== 0 && $categoryStatus === true);

        $this->productFrontRepository->persistAndFlush($productFront);
    }

    /**
     * @param ProductBack $productBack
     */
    protected function synchronizeProductLite(ProductBack $productBack): void
    {
        try {
            $product = $this->getProductFromProductBack($productBack);
        } catch (ProductBackNotFoundException $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return;
        }

        try {
            $productFront = $this->getProductFrontFromProduct($product);
        } catch (ProductFrontNotFoundException $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return;
        }

        $this->updateProductFrontFromProductBackLite($productBack, $productFront);

        $this->eventDispatcher->dispatch(new ProductSynchronizedLiteEvent($product));
    }
}