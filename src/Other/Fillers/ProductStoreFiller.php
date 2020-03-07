<?php

namespace App\Other\Fillers;

use App\Entity\Front\ProductStore as ProductStoreFront;

class ProductStoreFiller
{
    public static function backToFront(ProductStoreFront $productStoreFront, int $productFrontId, int $storeId)
    {
        $productStoreFront->setProductId($productFrontId);
        $productStoreFront->setStoreId($storeId);

        return $productStoreFront;
    }
}