<?php

namespace App\Other\Fillers;

use App\Entity\Front\ProductLayout as ProductLayoutFront;

class ProductLayoutFiller extends Filler
{
    /**
     * @param ProductLayoutFront $productLayoutFront
     * @param int $productFrontId
     * @param int $storeId
     * @param int $layoutId
     * @return ProductLayoutFront
     */
    public static function backToFront(ProductLayoutFront $productLayoutFront, int $productFrontId, int $storeId, int $layoutId)
    {
        $productLayoutFront->setProductId($productFrontId);
        $productLayoutFront->setStoreId($storeId);
        $productLayoutFront->setLayoutId($layoutId);

        return $productLayoutFront;
    }
}