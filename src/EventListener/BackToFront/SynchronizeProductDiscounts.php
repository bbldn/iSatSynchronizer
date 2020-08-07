<?php

namespace App\EventListener\BackToFront;

use App\Contract\BackToFront\ProductDiscountSpeedSynchronizerInterface;
use App\Event\BackToFront\PriceSynchronizeAllFastEvent;
use App\Event\BackToFront\PriceSynchronizeEvent;
use App\Event\BackToFront\PriceSynchronizeFastEvent;
use App\Event\BackToFront\ProductSynchronizedEvent;
use App\Exception\ProductNotFoundException;
use App\Helper\ExceptionFormatter;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SynchronizeProductDiscounts implements EventSubscriberInterface
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var ProductDiscountSpeedSynchronizerInterface $productDiscountBackToFrontSynchronizer */
    protected $productDiscountBackToFrontSynchronizer;

    /** @var bool $synchronizerLoaded */
    protected $synchronizerLoaded = false;

    /**
     * SynchronizeProductDiscount constructor.
     * @param LoggerInterface $logger
     * @param ProductDiscountSpeedSynchronizerInterface $productDiscountBackToFrontSynchronizer
     */
    public function __construct(
        LoggerInterface $logger,
        ProductDiscountSpeedSynchronizerInterface $productDiscountBackToFrontSynchronizer
    )
    {
        $this->logger = $logger;
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

    public function action(ProductSynchronizedEvent $event): void
    {
        try {
            $this->_action($event);
        } catch (ProductNotFoundException $e) {
            $this->logger->error(ExceptionFormatter::e($e));
        }
    }

    /**
     * @param ProductSynchronizedEvent $event
     * @throws ProductNotFoundException
     */
    protected function _action(ProductSynchronizedEvent $event): void
    {
        if (false === $this->synchronizerLoaded) {
            $this->productDiscountBackToFrontSynchronizer->load();
            $this->synchronizerLoaded = true;
        }

        $product = $event->getProduct();
        if (null === $product) {
            throw new ProductNotFoundException("Product not found");
        }

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