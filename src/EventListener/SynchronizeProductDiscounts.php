<?php

namespace App\EventListener;

use App\Event\BackToFront\PriceSynchronizeAllFastEvent;
use App\Event\BackToFront\PriceSynchronizeEvent;
use App\Event\BackToFront\PriceSynchronizeFastEvent;
use App\Event\BackToFront\ProductSynchronizedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Service\Synchronizer\BackToFront\ProductDiscountSpeedSynchronizer as ProductDiscountBackToFrontSynchronizer;

class SynchronizeProductDiscounts implements EventSubscriberInterface
{
    /** @var ProductDiscountBackToFrontSynchronizer $productDiscountBackToFrontSynchronizer */
    protected $productDiscountBackToFrontSynchronizer;

    /**
     * SynchronizeProductDiscount constructor.
     * @param ProductDiscountBackToFrontSynchronizer $productDiscountBackToFrontSynchronizer
     */
    public function __construct(ProductDiscountBackToFrontSynchronizer $productDiscountBackToFrontSynchronizer)
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
        $this->productDiscountBackToFrontSynchronizer->load();

        $product = $event->getProduct();
        $this->productDiscountBackToFrontSynchronizer->createOrUpdateDiscountItems($product->getFrontId());
        $this->productDiscountBackToFrontSynchronizer->synchronizeByProductBackId($product->getBackId());
    }

    /**
     * @param PriceSynchronizeEvent $event
     */
    public function actionData(PriceSynchronizeEvent $event): void
    {
        $this->productDiscountBackToFrontSynchronizer->load();

        foreach ($event->getData() as $value) {
            $this->productDiscountBackToFrontSynchronizer->synchronizeByProductBackId($value['productId']);
        }
    }

    /**
     * @param PriceSynchronizeFastEvent $event
     */
    public function actionDataFast(PriceSynchronizeFastEvent $event): void
    {
        $this->productDiscountBackToFrontSynchronizer->load()->synchronizeByIds($event->getIds());
    }

    /**
     *
     */
    public function actionDataAllFast(): void
    {
        $this->productDiscountBackToFrontSynchronizer->load()->synchronizeAll();
    }
}