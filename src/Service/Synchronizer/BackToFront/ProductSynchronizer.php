<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\ProductSynchronizerInterface;
use App\Event\BackToFront\PriceSynchronizeAllFastEvent;
use App\Event\BackToFront\PriceSynchronizeEvent;
use App\Event\BackToFront\PriceSynchronizeFastEvent;
use App\Event\BackToFront\ProductsAllSynchronizedEvent;
use App\Event\BackToFront\ProductsClearEvent;
use App\Event\BackToFront\ProductsSynchronizedEvent;
use App\Event\BackToFront\ProductSynchronizedEvent;
use App\Service\Synchronizer\BackToFront\Implementation\ProductSynchronizer as ProductBaseSynchronizer;

class ProductSynchronizer extends ProductBaseSynchronizer implements ProductSynchronizerInterface
{
    /**
     * @param bool $synchronizeImage
     */
    public function synchronizeAll(bool $synchronizeImage = false): void
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
     * @param string $ids
     * @param bool $synchronizeImage
     */
    public function synchronizeByIds(string $ids, bool $synchronizeImage = false): void
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
     * @param int $id
     * @param bool $synchronizeImage
     */
    public function synchronizeByCategoryId(int $id, bool $synchronizeImage = false): void
    {
        $this->events[ProductSynchronizedEvent::class] = 1;
        $this->events[ProductsSynchronizedEvent::class] = 1;

        $productsBack = $this->productBackRepository->findByCategoryId($id);
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
    public function synchronizeByName(string $name, bool $synchronizeImage = false): void
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
     * @param bool $reloadImage
     */
    public function reload(bool $reloadImage = false): void
    {
        $this->clear($reloadImage);
        $this->synchronizeAll($reloadImage);
    }

    /**
     * @param bool $clearImage
     */
    public function clear(bool $clearImage = false): void
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

        if (true === $this->synchronizeImage) {
            $this->descriptionHelper->clearFolder();
        }

        if (1 === $this->events[ProductsClearEvent::class]) {
            $this->eventDispatcher->dispatch(new ProductsClearEvent($this->synchronizeImage));
        }
    }

    /**
     *
     */
    public function load(): void
    {
        parent::load();
        $this->descriptionHelper->load();
        $this->manufacturerHelper->load();
    }

    /**
     *
     */
    public function synchronizePriceAll(): void
    {
        $this->events[PriceSynchronizeEvent::class] = 1;

        $products = $this->productBackRepository->getPricesAll();
        $this->productFrontRepository->updatePriceByData($products);

        if (1 === $this->events[PriceSynchronizeEvent::class]) {
            $this->eventDispatcher->dispatch(new PriceSynchronizeEvent($products));
        }
    }

    /**
     * @param string $ids
     */
    public function synchronizePriceByIds(string $ids): void
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
    public function synchronizePriceByCategoryIds(string $ids): void
    {
        $this->events[PriceSynchronizeEvent::class] = 1;

        $products = $this->productBackRepository->getPricesByCategoryIds($ids);
        $this->productFrontRepository->updatePriceByData($products);

        if (1 === $this->events[PriceSynchronizeEvent::class]) {
            $this->eventDispatcher->dispatch(new PriceSynchronizeEvent($products));
        }
    }

    /**
     * @param string $ids
     */
    public function synchronizePriceByIdsFast(string $ids): void
    {
        $this->events[PriceSynchronizeFastEvent::class] = 1;

        $products = $this->productBackRepository->getPricesByIds($ids);
        $this->productFrontRepository->updatePriceByData($products);

        if (1 === $this->events[PriceSynchronizeFastEvent::class]) {
            $this->eventDispatcher->dispatch(new PriceSynchronizeFastEvent($ids));
        }
    }

    /**
     *
     */
    public function synchronizePriceAllFast(): void
    {
        $this->events[PriceSynchronizeAllFastEvent::class] = 1;

        $products = $this->productBackRepository->getPricesAll();
        $this->productFrontRepository->updatePriceByData($products);

        if (1 === $this->events[PriceSynchronizeAllFastEvent::class]) {
            $this->eventDispatcher->dispatch(new PriceSynchronizeAllFastEvent());
        }
    }

    /**
     * @param bool $synchronizeImage
     */
    public function synchronizeLast(bool $synchronizeImage = false): void
    {
        $this->events[ProductSynchronizedEvent::class] = 1;
        $this->events[ProductsSynchronizedEvent::class] = 1;

        $productsBack = $this->productBackRepository->findLast();
        foreach ($productsBack as $productBack) {
            $this->synchronizeProduct($productBack, $synchronizeImage);
        }

        if (1 === $this->events[ProductsSynchronizedEvent::class]) {
            $this->eventDispatcher->dispatch(new ProductsSynchronizedEvent($this->synchronizedProducts));
        }
    }
}