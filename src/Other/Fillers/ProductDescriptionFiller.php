<?php

namespace App\Other\Fillers;

use App\Entity\Front\ProductDescription as ProductDescriptionFront;
use App\Entity\Back\Product as ProductBack;

class ProductDescriptionFiller
{
    public static function backToFront(ProductBack $productBack,
                                       ProductDescriptionFront $productDescriptionFront,
                                       int $productFrontId,
                                       int $languageId)
    {
        $productDescriptionFront->setProductId($productFrontId);
        $productDescriptionFront->setLanguageId($languageId);
        $productDescriptionFront->setName(mb_convert_encoding($productBack->getName(), 'utf-8', 'windows-1251'));
        $productDescriptionFront->setDescription(mb_convert_encoding($productBack->getDescription(), 'utf-8', 'windows-1251'));
        $productDescriptionFront->setTag('');
        $productDescriptionFront->setMetaTitle(mb_convert_encoding($productBack->getName(), 'utf-8', 'windows-1251'));
        $productDescriptionFront->setMetaH1('');
        $productDescriptionFront->setMetaDescription('');
        $productDescriptionFront->setMetaKeyword('');

        return $productDescriptionFront;
    }
}