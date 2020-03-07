<?php

namespace App\Other\Fillers;

use App\Entity\Front\ProductCategory as ProductCategoryFront;

class ProductCategoryFiller
{
    public static function backToFront(ProductCategoryFront $productCategoryFront,
                                       int $productFrontId,
                                       int $categoryFrontId,
                                       bool $mainCategory)
    {
        $productCategoryFront->setProductId($productFrontId);
        $productCategoryFront->setCategoryId($categoryFrontId);
        $productCategoryFront->setMainCategory($mainCategory);

        return $productCategoryFront;
    }
}