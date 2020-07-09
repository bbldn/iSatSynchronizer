<?php

namespace App\Contract\BackToFront;

use App\Entity\Front\Category as CategoryFront;

interface ProductSynchronizerHelperContract
{
    /**
     * @param int|null $categoryBackId
     * @return CategoryFront|null
     */
    public function getCategoryFrontByCategoryBackId(?int $categoryBackId): ?CategoryFront;
}