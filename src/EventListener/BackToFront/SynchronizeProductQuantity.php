<?php

namespace App\EventListener\BackToFront;

use App\Event\BackToFront\ProductSynchronizedEvent;
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
        ];
    }

    /**
     * @param ProductSynchronizedEvent $event
     */
    public function action(ProductSynchronizedEvent $event): void
    {
        try {
            $this->_action($event);
        } catch (Throwable $e) {
            $this->logger->error(ExceptionFormatter::e($e));
        }
    }

    /**
     * @param ProductSynchronizedEvent $event
     * @throws Throwable
     */
    protected function _action(ProductSynchronizedEvent $event): void
    {
        $product = $event->getProduct();
        if (null === $product) {
            $message = "Product not found";
            throw new ProductNotFoundException($message);
        }

        $this->productQuantityHelper->action($product);
    }
}