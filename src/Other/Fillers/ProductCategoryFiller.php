<?php

namespace App\Other\Fillers;

use App\Entity\Front\ProductCategory as ProductCategoryFront;

class ProductCategoryFiller
{
    public static function backToFront(ProductCategoryFront $productCategoryFront,
                                       int $productFrontId,
                                       int $categoryFrontId)
    {
        $productCategoryFront->setProductId($productFrontId);
        $productCategoryFront->setCategoryId($categoryFrontId);

        return $productCategoryFront;
    }
}