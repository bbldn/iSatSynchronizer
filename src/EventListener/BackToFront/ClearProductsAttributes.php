<?php

namespace App\EventListener\BackToFront;

use App\Contract\BackToFront\ProductAttributeSynchronizerInterface;
use App\Event\BackToFront\ProductsClearEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClearProductsAttributes implements EventSubscriberInterface
{
    /** @var ProductAttributeSynchronizerInterface $productAttributeSynchronizer */
    protected $productAttributeSynchronizer;

    /** @var bool $synchronizerLoaded */
    protected $synchronizerLoaded = false;

    /**
     * ClearProductsAttributes constructor.
     * @param ProductAttributeSynchronizerInterface $productAttributeSynchronizer
     */
    public function __construct(ProductAttributeSynchronizerInterface $productAttributeSynchronizer)
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