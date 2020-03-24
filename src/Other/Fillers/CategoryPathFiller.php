<?php

namespace App\Other\Fillers;

use App\Entity\Front\CategoryPath as CategoryPathFront;

class CategoryPathFiller extends Filler
{
    /**
     * @param CategoryPathFront $categoryPathFront
     * @param int $categoryId
     * @param int $pathId
     * @param int $level
     * @return CategoryPathFront
     */
    public static function backToFront(CategoryPathFront $categoryPathFront, int $categoryId, int $pathId, int $level)
    {
        $categoryPathFront->setCategoryId($categoryId);
        $categoryPathFront->setPathId($pathId);
        $categoryPathFront->setLevel($level);

        return $categoryPathFront;
    }
}