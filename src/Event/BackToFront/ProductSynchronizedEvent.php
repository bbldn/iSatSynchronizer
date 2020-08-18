<?php

namespace App\Event\BackToFront;

use App\Entity\Product;
use Symfony\Contracts\EventDispatcher\Event;

class ProductSynchronizedEvent extends Event implements ProductSynchronizedInterface
{
    /** @var Product $product */
    protected $product;

    /** @var bool $synchronizeImage */
    protected $synchronizeImage;

    /**
     * ProductSynchronizedBackToFront constructor.
     * @param Product $product
     * @param bool $synchronizeImage
     */
    public function __construct(Product $product, bool $synchronizeImage)
    {
        $this->product = $product;
        $this->synchronizeImage = $synchronizeImage;
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

    /**
     * @return bool
     */
    public function isSynchronizeImage(): bool
    {
        return $this->synchronizeImage;
    }

    /**
     * @param bool $synchronizeImage
     * @return ProductSynchronizedEvent
     */
    public function setSynchronizeImage(bool $synchronizeImage): self
    {
        $this->synchronizeImage = $synchronizeImage;

        return $this;
    }
}