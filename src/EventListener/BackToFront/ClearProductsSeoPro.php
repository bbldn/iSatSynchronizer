<?php

namespace App\EventListener\BackToFront;

use App\Contract\BackToFront\ProductSeoUrlSynchronizerInterface;
use App\Event\BackToFront\ProductsClearEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClearProductsSeoPro implements EventSubscriberInterface
{
    /** @var ProductSeoUrlSynchronizerInterface $productSeoUrlBackToFrontSynchronizer */
    protected $productSeoUrlBackToFrontSynchronizer;

    /** @var bool $synchronizerLoaded */
    protected $synchronizerLoaded = false;

    /**
     * ClearProductSeoPro constructor.
     * @param ProductSeoUrlSynchronizerInterface $productSeoUrlBackToFrontSynchronizer
     */
    public function __construct(ProductSeoUrlSynchronizerInterface $productSeoUrlBackToFrontSynchronizer)
    {
        $this->productSeoUrlBackToFrontSynchronizer = $productSeoUrlBackToFrontSynchronizer;
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
        if (false === $this->synchronizerLoaded) {
            $this->productSeoUrlBackToFrontSynchronizer->load();
            $this->synchronizerLoaded = true;
        }

        $this->productSeoUrlBackToFrontSynchronizer->clear();
    }
}