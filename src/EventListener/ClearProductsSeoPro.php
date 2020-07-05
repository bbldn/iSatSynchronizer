<?php

namespace App\EventListener;

use App\Event\ProductsClearBackToFrontEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Service\Synchronizer\BackToFront\ProductSeoUrlSynchronizer as ProductSeoUrlBackToFrontSynchronizer;

class ClearProductsSeoPro implements EventSubscriberInterface
{
    /** @var ProductSeoUrlBackToFrontSynchronizer $productSeoUrlBackToFrontSynchronizer */
    protected $productSeoUrlBackToFrontSynchronizer;

    /**
     * ClearProductSeoPro constructor.
     * @param ProductSeoUrlBackToFrontSynchronizer $productSeoUrlBackToFrontSynchronizer
     */
    public function __construct(
        ProductSeoUrlBackToFrontSynchronizer $productSeoUrlBackToFrontSynchronizer
    )
    {
        $this->productSeoUrlBackToFrontSynchronizer = $productSeoUrlBackToFrontSynchronizer;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ProductsClearBackToFrontEvent::class => 'action',
        ];
    }

    /**
     *
     */
    public function action(): void
    {
        $this->productSeoUrlBackToFrontSynchronizer->clear();
    }
}