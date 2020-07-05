<?php

namespace App\EventListener;

use App\Service\Synchronizer\BackToFront\ProductAttributeSynchronizer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClearProductsAttributes implements EventSubscriberInterface
{
    /** @var ProductAttributeSynchronizer $productAttributeSynchronizer */
    protected $productAttributeSynchronizer;

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
            ProductAttributeSynchronizer::class => 'action',
        ];
    }

    /**
     *
     */
    public function action(): void
    {
        $this->productAttributeSynchronizer->clear();
    }
}