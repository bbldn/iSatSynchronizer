<?php

namespace App\Other\Fillers;

use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\ProductDescription as ProductDescriptionFront;
use App\Other\Store;

class ProductDescriptionFiller
{
    /**
     * @param ProductBack $productBack
     * @param ProductDescriptionFront $productDescriptionFront
     * @param int $productFrontId
     * @param int $languageId
     * @return ProductDescriptionFront
     */
    public static function backToFront(ProductBack $productBack,
                                       ProductDescriptionFront $productDescriptionFront,
                                       int $productFrontId,
                                       int $languageId)
    {
        $productDescriptionFront->setProductId($productFrontId);
        $productDescriptionFront->setLanguageId($languageId);
        $productDescriptionFront->setName(Filler::securityString(Store::encodingConvert($productBack->getName())));
        $productDescriptionFront->setDescription(Filler::securityString(Store::encodingConvert($productBack->getDescription())));
        $productDescriptionFront->setTag(Filler::securityString(null));
        $productDescriptionFront->setMetaTitle(Filler::securityString(Store::encodingConvert($productBack->getName())));
        $productDescriptionFront->setMetaDescription(Filler::securityString(null));
        $productDescriptionFront->setMetaKeyword(Filler::securityString(null));

        return $productDescriptionFront;
    }
}