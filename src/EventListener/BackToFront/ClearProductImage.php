<?php

namespace App\EventListener\BackToFront;

use App\Event\BackToFront\ProductsClearEvent;
use App\Service\Synchronizer\BackToFront\ProductImageSynchronizer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClearProductImage implements EventSubscriberInterface
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
            ProductsClearEvent::class => 'action',
        ];
    }

    /**
     *
     */
    public function action(): void
    {
        $this->productImageSynchronizer->load()->clearFolder();
    }
}