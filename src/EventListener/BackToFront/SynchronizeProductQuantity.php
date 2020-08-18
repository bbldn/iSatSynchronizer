<?php

namespace App\EventListener\BackToFront;

use App\Event\BackToFront\ProductSynchronizedEvent;
use App\Event\BackToFront\ProductSynchronizedInterface;
use App\Event\BackToFront\ProductSynchronizedLiteEvent;
use App\Exception\ProductNotFoundException;
use App\Helper\BackToFront\ProductQuantityHelper;
use App\Helper\ExceptionFormatter;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Throwable;

class SynchronizeProductQuantity implements EventSubscriberInterface
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var ProductQuantityHelper $productQuantityHelper */
    protected $productQuantityHelper;

    /**
     * SynchronizeProductQuantity constructor.
     * @param LoggerInterface $logger
     * @param ProductQuantityHelper $productQuantityHelper
     */
    public function __construct(
        LoggerInterface $logger,
        ProductQuantityHelper $productQuantityHelper
    )
    {
        $this->logger = $logger;
        $this->productQuantityHelper = $productQuantityHelper;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ProductSynchronizedEvent::class => 'action',
            ProductSynchronizedLiteEvent::class => 'action',
        ];
    }

    /**
     * @param ProductSynchronizedInterface $event
     */
    public function action(ProductSynchronizedInterface $event): void
    {
        try {
            $this->_action($event);
        } catch (Throwable $e) {
            $this->logger->error(ExceptionFormatter::e($e));
        }
    }

    /**
     * @param ProductSynchronizedInterface $event
     * @throws Throwable
     */
    protected function _action(ProductSynchronizedInterface $event): void
    {
        $product = $event->getProduct();
        if (null === $product) {
            throw new ProductNotFoundException("Product not found");
        }

        $this->productQuantityHelper->action($product);
    }
}