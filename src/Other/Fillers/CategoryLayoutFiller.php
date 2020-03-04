<?php

namespace App\Other\Fillers;

use App\Entity\Front\CategoryLayout;

class CategoryLayoutFiller
{
    public static function backToFront(CategoryLayout $categoryLayout, int $categoryId, int $storeId, int $layoutId)
    {
        $categoryLayout->setCategoryId($categoryId);
        $categoryLayout->setStoreId($storeId);
        $categoryLayout->setLayoutId($layoutId);

        return $categoryLayout;
    }
}