<?php

namespace App\Event;

use App\Entity\Product;
use Symfony\Contracts\EventDispatcher\Event;

class ProductSynchronizedBackToFrontEvent extends Event
{
    public const NAME = 'product.synchronized.backToFront';

    /** @var Product $product */
    protected $product;

    /**
     * ProductSynchronizedBackToFront constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return ProductSynchronizedBackToFrontEvent
     */
    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}