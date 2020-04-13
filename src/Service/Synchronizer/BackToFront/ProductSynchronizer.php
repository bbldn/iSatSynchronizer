<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Exception\ProductBackNotFoundException;

class ProductSynchronizer extends ProductBaseSynchronizer
{
    /**
     * @param bool $synchronizeImage
     */
    public function synchronize($synchronizeImage = false): void
    {
        $productsBack = $this->productBackRepository->findAll();
        foreach ($productsBack as $productBack) {
            $this->synchronizeProduct($productBack, $synchronizeImage);
        }
    }

    /**
     * @param int $id
     * @param bool $synchronizeImage
     * @throws ProductBackNotFoundException
     */
    public function synchronizeOne(int $id, $synchronizeImage = false): void
    {
        $productBack = $this->productBackRepository->find($id);

        if ($productBack === null) {
            throw new ProductBackNotFoundException();
        }

        $this->synchronizeProduct($productBack, $synchronizeImage);
    }

    /**
     * @param int $id
     * @param bool $synchronizeImage
     */
    public function synchronizeByCategoryId(int $id, $synchronizeImage = false): void
    {
        $productsBack = $this->productBackRepository->findByCategoryId($id);
        foreach ($productsBack as $productBack) {
            $this->synchronizeProduct($productBack, $synchronizeImage);
        }
    }

    /**
     *
     */
    public function updatePriceAll()
    {
        $this->productFrontRepository->updateProductsPrice();
    }

    /**
     * @param string $ids
     */
    public function updatePriceByIds(string $ids)
    {
        $this->productFrontRepository->updateProductsPriceByIds($ids);
    }

    /**
     * @param bool $reloadImage
     */
    public function reload($reloadImage = false)
    {
        $this->clear($reloadImage);
        $this->synchronize($reloadImage);
    }
}