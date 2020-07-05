<?php

namespace App\EventListener;

use App\Event\BackToFront\ProductSynchronizedEvent;
use App\Service\Synchronizer\BackToFront\ProductImageSynchronizer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SynchronizeProductImage implements EventSubscriberInterface
{
    /** @var ProductImageSynchronizer $productImageSynchronizer */
    protected $productImageSynchronizer;

    /**
     * SynchronizeProductImage constructor.
     * @param ProductImageSynchronizer $productImageSynchronizer
     */
    public function __construct(ProductImageSynchronizer $productImageSynchronizer)
    {
        $this->productImageSynchronizer = $productImageSynchronizer;
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
        if (false === $event->isSynchronizeImage()) {
            return;
        }

        $this->productImageSynchronizer->synchronizeImage($productBack, $productFront);
    }
}