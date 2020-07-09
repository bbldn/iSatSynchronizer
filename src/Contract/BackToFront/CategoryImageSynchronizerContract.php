<?php

namespace App\Contract\BackToFront;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Front\Category as CategoryFront;

interface CategoryImageSynchronizerContract
{
    public function clearFolder(): void;
    public function synchronizeImage(CategoryBack $categoryBack, CategoryFront $categoryFront): void;
}