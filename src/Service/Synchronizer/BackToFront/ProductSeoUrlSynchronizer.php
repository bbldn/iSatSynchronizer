<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Service\Synchronizer\BackToFront\Implementation\ProductSeoUrlSynchronizer as ProductSeoUrlSynchronizerBase;
use App\Entity\Back\Product as ProductBack;
use App\Entity\Front\Product as ProductFront;

class ProductSeoUrlSynchronizer extends ProductSeoUrlSynchronizerBase
{
    /**
     *
     */
    public function load(): self
    {
        parent::load();
        $this->_load();

        return $this;
    }

    /**
     * @param ProductBack $productBack
     * @param ProductFront $productFront
     */
    public function synchronizeByProductBackAndProductFront(
        ProductBack $productBack,
        ProductFront $productFront
    ): void
    {
        if (true === $this->seoUrlTableExists) {
            parent::synchronizeByProductBackAndProductFront($productBack, $productFront);
        }
    }

    /**
     *
     */
    public function synchronizeAll(): void
    {
        if (true === $this->seoUrlTableExists) {
            parent::synchronizeAll();
        }
    }

    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void
    {
        if (true === $this->seoUrlTableExists) {
            parent::synchronizeByIds($ids);
        }
    }

    /**
     *
     */
    public function clearRemove(): void
    {
        if (true === $this->seoUrlTableExists) {
            parent::clearRemove();
        }
    }
}