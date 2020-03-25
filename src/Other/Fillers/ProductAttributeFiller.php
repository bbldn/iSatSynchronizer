<?php

namespace App\Other\Fillers;

use App\Entity\Front\ProductAttribute as ProductAttributeFront;
use App\Other\Store;

class ProductAttributeFiller
{
    /**
     * @param ProductAttributeFront $productAttributeFront
     * @param int $productId
     * @param int $attributeId
     * @param int $languageId
     * @param string $text
     * @return ProductAttributeFront
     */
    public static function backToFront(ProductAttributeFront $productAttributeFront,
                                       int $productId,
                                       int $attributeId,
                                       int $languageId,
                                       string $text)
    {
        $productAttributeFront->setProductId($productId);
        $productAttributeFront->setAttributeId($attributeId);
        $productAttributeFront->setLanguageId($languageId);
        $productAttributeFront->setText(Filler::securityString(Store::encodingConvert($text)));

        return $productAttributeFront;
    }
}