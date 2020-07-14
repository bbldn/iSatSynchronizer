<?php

namespace App\EventListener\BackToFront;

use App\Contract\BackToFront\ProductAttributeSynchronizerContract;
use App\Event\BackToFront\ProductsClearEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClearProductsAttributes implements EventSubscriberInterface
{
    /** @var ProductAttributeSynchronizerContract $productAttributeSynchronizer */
    protected $productAttributeSynchronizer;

    /** @var bool $synchronizerLoaded */
    protected $synchronizerLoaded = false;

    /**
     * ClearProductsAttributes constructor.
     * @param ProductAttributeSynchronizerContract $productAttributeSynchronizer
     */
    public function __construct(ProductAttributeSynchronizerContract $productAttributeSynchronizer)
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