<?php

namespace App\EventListener\BackToFront;

use App\Event\BackToFront\ProductsClearEvent;
use App\Service\Synchronizer\BackToFront\ProductAttributeSynchronizer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClearProductsAttributes implements EventSubscriberInterface
{
    /** @var ProductAttributeSynchronizer $productAttributeSynchronizer */
    protected $productAttributeSynchronizer;

    /** @var bool $synchronizerLoaded */
    protected $synchronizerLoaded = false;

    /**
     * ClearProductsAttributes constructor.
     * @param ProductAttributeSynchronizer $productAttributeSynchronizer
     */
    public function __construct(
        ProductAttributeSynchronizer $productAttributeSynchronizer
    )
    {
        $this->productAttributeSynchronizer = $productAttributeSynchronizer;
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
            $this->productAttributeSynchronizer->load();
            $this->synchronizerLoaded = true;
        }

        $this->productAttributeSynchronizer->clear();
    }
}