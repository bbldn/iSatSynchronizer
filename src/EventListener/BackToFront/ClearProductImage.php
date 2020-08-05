<?php

namespace App\EventListener\BackToFront;

use App\Contract\BackToFront\ProductImageSynchronizerInterface;
use App\Event\BackToFront\ProductsClearEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClearProductImage implements EventSubscriberInterface
{
    /** @var ProductImageSynchronizerInterface $productImageSynchronizer */
    protected $productImageSynchronizer;

    /** @var bool $synchronizerLoaded */
    protected $synchronizerLoaded = false;

    /**
     * SynchronizeProductImage constructor.
     * @param ProductImageSynchronizerInterface $productImageSynchronizer
     */
    public function __construct(ProductImageSynchronizerInterface $productImageSynchronizer)
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
        if (false === $this->synchronizerLoaded) {
            $this->productImageSynchronizer->load();
            $this->synchronizerLoaded = true;
        }

        $this->productImageSynchronizer->clearFolder();
    }
}