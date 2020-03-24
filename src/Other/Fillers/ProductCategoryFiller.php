<?php

namespace App\Other\Fillers;

use App\Entity\Front\ProductCategory as ProductCategoryFront;

class ProductCategoryFiller extends Filler
{
    /**
     * @param ProductCategoryFront $productCategoryFront
     * @param int $productFrontId
     * @param int $categoryFrontId
     * @return ProductCategoryFront
     */
    public static function backToFront(ProductCategoryFront $productCategoryFront, int $productFrontId, int $categoryFrontId)
    {
        $productCategoryFront->setProductId($productFrontId);
        $productCategoryFront->setCategoryId($categoryFrontId);

        return $productCategoryFront;
    }
}