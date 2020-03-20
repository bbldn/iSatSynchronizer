<?php

namespace App\Other\Fillers;

use App\Entity\Front\ProductAttribute as ProductAttributeFront;

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
        $productAttributeFront->setText(mb_convert_encoding($text, 'utf-8', 'windows-1251'));

        return $productAttributeFront;
    }
}