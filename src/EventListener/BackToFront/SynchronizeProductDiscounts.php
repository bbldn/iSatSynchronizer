<?php

namespace App\EventListener\BackToFront;

use App\Contract\BackToFront\ProductDiscountSpeedSynchronizerContract;
use App\Event\BackToFront\PriceSynchronizeAllFastEvent;
use App\Event\BackToFront\PriceSynchronizeEvent;
use App\Event\BackToFront\PriceSynchronizeFastEvent;
use App\Event\BackToFront\ProductSynchronizedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SynchronizeProductDiscounts implements EventSubscriberInterface
{
    /** @var ProductDiscountSpeedSynchronizerContract $productDiscountBackToFrontSynchronizer */
    protected $productDiscountBackToFrontSynchronizer;

    /** @var bool $synchronizerLoaded */
    protected $synchronizerLoaded = false;

    /**
     * SynchronizeProductDiscount constructor.
     * @param ProductDiscountSpeedSynchronizerContract $productDiscountBackToFrontSynchronizer
     */
    public function __construct(ProductDiscountSpeedSynchronizerContract $productDiscountBackToFrontSynchronizer)
    {
        $this->productDiscountBackToFrontSynchronizer = $productDiscountBackToFrontSynchronizer;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ProductSynchronizedEvent::class => 'action',
            PriceSynchronizeEvent::class => 'actionData',
            PriceSynchronizeFastEvent::class => 'actionDataFast',
            PriceSynchronizeAllFastEvent::class => 'actionDataAllFast',
        ];
    }

    /**
     * @param ProductSynchronizedEvent $event
     */
    public function action(ProductSynchronizedEvent $event): void
    {
        if (false === $this->synchronizerLoaded) {
            $this->productDiscountBackToFrontSynchronizer->load();
            $this->synchronizerLoaded = true;
        }

        $product = $event->getProduct();
        $this->productDiscountBackToFrontSynchronizer->createOrUpdateDiscountItems($product->getFrontId());
        $this->productDiscountBackToFrontSynchronizer->synchronizeByProductBackId($product->getBackId());
    }

    /**
     * @param PriceSynchronizeEvent $event
     */
    public function actionData(PriceSynchronizeEvent $event): void
    {
        if (false === $this->synchronizerLoaded) {
            $this->productDiscountBackToFrontSynchronizer->load();
            $this->synchronizerLoaded = true;
        }

        foreach ($event->getData() as $value) {
            $this->productDiscountBackToFrontSynchronizer->synchronizeByProductBackId($value['productId']);
        }
    }

    /**
     * @param PriceSynchronizeFastEvent $event
     */
    public function actionDataFast(PriceSynchronizeFastEvent $event): void
    {
        if (false === $this->synchronizerLoaded) {
            $this->productDiscountBackToFrontSynchronizer->load();
            $this->synchronizerLoaded = true;
        }

        $this->productDiscountBackToFrontSynchronizer->synchronizeByIds($event->getIds());
    }

    /**
     *
     */
    public function actionDataAllFast(): void
    {
        if (false === $this->synchronizerLoaded) {
            $this->productDiscountBackToFrontSynchronizer->load();
            $this->synchronizerLoaded = true;
        }

        $this->productDiscountBackToFrontSynchronizer->synchronizeAll();
    }
}