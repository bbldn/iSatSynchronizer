<?php

namespace App\Event\BackToFront;

use App\Entity\Product;

interface ProductSynchronizedInterface
{
    /**
     * @return Product
     */
    public function getProduct(): Product;

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void;
}