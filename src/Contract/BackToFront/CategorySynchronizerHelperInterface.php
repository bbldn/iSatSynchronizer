<?php

namespace App\Contract\BackToFront;

use App\Entity\Back\Category as CategoryBack;

interface CategorySynchronizerHelperInterface
{
    /**
     * @param CategoryBack $categoryBack
     * @return int
     */
    public function getParentIdFromCategoryBack(CategoryBack $categoryBack): int;
}