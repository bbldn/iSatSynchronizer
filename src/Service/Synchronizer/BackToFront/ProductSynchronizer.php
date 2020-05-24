<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Service\Synchronizer\BackToFront\Implementation\ProductSynchronizer as ProductBaseSynchronizer;

class ProductSynchronizer extends ProductBaseSynchronizer
{
    /**
     * @param string $ids
     * @param bool $synchronizeImage
     */
    public function synchronizeByIds(string $ids, $synchronizeImage = false): void
    {
        $productsBack = $this->productBackRepository->findByIds($ids);

        foreach ($productsBack as $productBack) {
            $this->synchronizeProduct($productBack, $synchronizeImage);
        }
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
        $data = $this->productBackRepository->getBackPrices();
        $this->productFrontRepository->updatePriceByData($data);
    }

    /**
     * @param string $ids
     */
    public function updatePriceByIds(string $ids)
    {
        $data = $this->productBackRepository->getBackPricesByIds($ids);
        $this->productFrontRepository->updatePriceByData($data);
    }

    /**
     * @param string $ids
     */
    public function updatePriceByCategoryIds(string $ids)
    {
        $data = $this->productBackRepository->getBackPricesByCategoryIds($ids);
        $this->productFrontRepository->updatePriceByData($data);
    }

    /**
     * @param bool $reloadImage
     */
    public function reload($reloadImage = false)
    {
        $this->clear($reloadImage);
        $this->synchronizeAll($reloadImage);
    }

    /**
     * @param bool $clearImage
     */
    public function clear($clearImage = false): void
    {
        parent::clear($clearImage);
    }

    /**
     * @param bool $synchronizeImage
     */
    public function synchronizeAll($synchronizeImage = false): void
    {
        $productsBack = $this->productBackRepository->findAll();
        foreach ($productsBack as $productBack) {
            $this->synchronizeProduct($productBack, $synchronizeImage);
        }
    }
}