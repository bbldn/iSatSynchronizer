<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\ProductSeoUrlSynchronizerInterface;
use App\Service\Synchronizer\BackToFront\Implementation\ProductSeoUrlSynchronizer as ProductSeoUrlSynchronizerBase;

class ProductSeoUrlSynchronizer extends ProductSeoUrlSynchronizerBase implements ProductSeoUrlSynchronizerInterface
{
    /**
     *
     */
    public function load(): void
    {
        parent::load();
        $this->seoUrlTableExists = $this->seoUrlFrontRepository->tableExists();
    }

    /**
     *
     */
    public function synchronizeAll(): void
    {
        if (false === $this->seoUrlTableExists) {
            return;
        }

        $productsBack = $this->productBackRepository->findAll();
        foreach ($productsBack as $productBack) {
            $this->synchronizeByProductBack($productBack);
        }
    }

    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void
    {
        if (false === $this->seoUrlTableExists) {
            return;
        }

        $productsBack = $this->productBackRepository->findByIds($ids);
        foreach ($productsBack as $productBack) {
            $this->synchronizeByProductBack($productBack);
        }
    }

    /**
     *
     */
    public function clear(): void
    {
        if (true === $this->seoUrlTableExists) {
            $this->seoUrlFrontRepository->removeAllByQuery('product_id');
        }
    }

    /**
     *
     */
    public function reload(): void
    {
        $this->clear();
        $this->synchronizeAll();
    }
}