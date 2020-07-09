<?php

namespace App\Contract\BackToFront;

use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\SeoUrl as SeoUrlFront;

interface ProductSeoUrlSynchronizerContract
{
    /**
     *
     */
    public function load(): void;

    /**
     *
     */
    public function synchronizeAll(): void;

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

    /**
     *
     */
    public function clear(): void;
}