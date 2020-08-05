<?php

namespace App\Contract\BackToFront;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Front\Category as CategoryFront;

interface CategoryImageSynchronizerInterface
{
    /**
     *
     */
    public function clearFolder(): void;

    /**
     * @param CategoryBack $categoryBack
     * @param CategoryFront $categoryFront
     */
    public function synchronizeImage(CategoryBack $categoryBack, CategoryFront $categoryFront): void;
}