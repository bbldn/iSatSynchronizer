<?php

namespace App\Other\Fillers;

use App\Entity\Front\CategoryStore;

class CategoryStoreFiller
{
    public static function backToFront(CategoryStore $categoryStore, int $categoryId, int $storeId)
    {
        $categoryStore->setCategoryId($categoryId);
        $categoryStore->setStoreId($storeId);

        return $categoryStore;
    }
}