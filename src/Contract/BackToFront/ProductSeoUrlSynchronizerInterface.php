<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;
use App\Contract\CanReloadInterface;
use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\SeoUrl as SeoUrlFront;

interface ProductSeoUrlSynchronizerInterface extends CanLoadInterface, CanReloadInterface
{
    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void;

    /**
     * @param ProductBack $productBack
     * @param ProductFront $productFront
     * @return SeoUrlFront|null
     */
    public function synchronizeByProductBackAndProductFront(
        ProductBack $productBack,
        ProductFront $productFront
    ): ?SeoUrlFront;
}