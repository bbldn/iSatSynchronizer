<?php

namespace App\Event\BackToFront;

use App\Entity\Product;
use Symfony\Contracts\EventDispatcher\Event;

class ProductsSynchronizedEvent extends Event
{
    /** @var Product[] $products */
    protected $products;

    /**
     * ProductsSynchronizedBackToFront constructor.
     * @param int[] $products
     */
    public function __construct(array $products)
    {
        $this->products = $products;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     * @return ProductsSynchronizedEvent
     */
    public function setProducts(array $products): self
    {
        $this->products = $products;

        return $this;
    }
}