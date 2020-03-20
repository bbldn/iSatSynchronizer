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
        $categoryDescriptionFront->setName(mb_convert_encoding($categoryBack->getName(), 'utf-8', 'windows-1251'));
        $categoryDescriptionFront->setDescription(mb_convert_encoding($categoryBack->getDescription(), 'utf-8', 'windows-1251'));
        $categoryDescriptionFront->setMetaTitle(mb_convert_encoding($categoryBack->getName(), 'utf-8', 'windows-1251'));
        $categoryDescriptionFront->setMetaDescription('');
        $categoryDescriptionFront->setMetaKeyword('');

        return $categoryDescriptionFront;
    }
}