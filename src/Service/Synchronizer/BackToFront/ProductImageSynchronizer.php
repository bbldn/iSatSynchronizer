<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\ProductImageSynchronizerContract;
use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;
use App\Service\Synchronizer\BackToFront\Implementation\ProductImageSynchronizer as ProductImageSynchronizerBase;

class ProductImageSynchronizer extends ProductImageSynchronizerBase implements ProductImageSynchronizerContract
{
    /**
     * @param ProductBack $productBack
     * @param ProductFront $productFront
     */
    public function synchronizeImage(ProductBack $productBack, ProductFront $productFront): void
    {
        parent::synchronizeImage($productBack, $productFront);
    }

    /**
     *
     */
    public function load(): void
    {
        parent::load();
    }

    /**
     * @param int $id
     */
    public function clearByProductFrontId(int $id): void
    {
        $this->productImageFrontRepository->removeAllByProductFrontId($id);
    }
}