<?php

namespace App\Other\Fillers;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Front\CategoryDescription;


class CategoryDescriptionFiller
{
    public static function backToFront(CategoryBack $categoryBack, CategoryDescription $categoryDescriptionFront, int $categoryId, int $languageId)
    {
        $categoryDescriptionFront->setCategoryId($categoryId);
        $categoryDescriptionFront->setLanguageId($languageId);
        $categoryDescriptionFront->setName($categoryBack->getName());
        $categoryDescriptionFront->setDescription($categoryBack->getDescription());
        $categoryDescriptionFront->setMetaTitle($categoryBack->getName());
        $categoryDescriptionFront->setMetaH1($categoryBack->getH1());
        $categoryDescriptionFront->setMetaDescription('');
        $categoryDescriptionFront->setMetaKeyword('');

        return $categoryDescriptionFront;
    }
}