<?php

namespace App\Event\BackToFront;

use App\Entity\Product;
use Symfony\Contracts\EventDispatcher\Event;

class ProductSynchronizedLiteEvent extends Event implements ProductSynchronizedInterface
{
    /** @var Product $product */
    protected $product;

    /**
     * ProductSynchronizedLiteEvent constructor.
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
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
}