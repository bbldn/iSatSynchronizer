<?php

namespace App\Other\Fillers;

use App\Entity\Front\CategoryStore;

class CategoryStoreFiller
{
    /**
     * @param CategoryStore $categoryStore
     * @param int $categoryId
     * @param int $storeId
     * @return CategoryStore
     */
    public static function backToFront(CategoryStore $categoryStore, int $categoryId, int $storeId)
    {
        $categoryStore->setCategoryId($categoryId);
        $categoryStore->setStoreId($storeId);

        return $categoryStore;
    }
}