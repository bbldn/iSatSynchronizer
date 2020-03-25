<?php

namespace App\Other\Fillers;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Front\CategoryDescription;
use App\Other\Store;


class CategoryDescriptionFiller
{
    /**
     * @param CategoryBack $categoryBack
     * @param CategoryDescription $categoryDescriptionFront
     * @param int $categoryId
     * @param int $languageId
     * @return CategoryDescription
     */
    public static function backToFront(CategoryBack $categoryBack, CategoryDescription $categoryDescriptionFront, int $categoryId, int $languageId)
    {
        $categoryDescriptionFront->setCategoryId($categoryId);
        $categoryDescriptionFront->setLanguageId($languageId);
        $categoryDescriptionFront->setName(Filler::securityString(Store::encodingConvert($categoryBack->getName())));
        $categoryDescriptionFront->setDescription(Filler::securityString(Store::encodingConvert($categoryBack->getDescription())));
        $categoryDescriptionFront->setMetaTitle(Filler::securityString(Store::encodingConvert($categoryBack->getName())));
        $categoryDescriptionFront->setMetaDescription(Filler::securityString(null));
        $categoryDescriptionFront->setMetaKeyword(Filler::securityString(null));

        return $categoryDescriptionFront;
    }
}