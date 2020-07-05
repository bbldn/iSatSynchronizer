<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Service\Synchronizer\BackToFront\Implementation\ProductSynchronizer as ProductBaseSynchronizer;

class ProductSynchronizer extends ProductBaseSynchronizer
{
    /**
     * @return ProductSynchronizer
     */
    public function load(): self
    {
        parent::load();
        $this->_load();

        return $this;
    }

    /**
     * @param string $ids
     * @param bool $synchronizeImage
     */
    public function synchronizeByIds(string $ids, bool $synchronizeImage = false): void
    {
        parent::synchronizeByIds($ids, $synchronizeImage);
    }

    /**
     * @param int $id
     * @param bool $synchronizeImage
     */
    public function synchronizeByCategoryId(int $id, bool $synchronizeImage = false): void
    {
        parent::synchronizeByCategoryId($id, $synchronizeImage);
    }

    /**
     * @param string $name
     * @param bool $synchronizeImage
     */
    public function synchronizeByName(string $name, bool $synchronizeImage = false): void
    {
        parent::synchronizeByName($name, $synchronizeImage);
    }

    /**
     * @param bool $synchronizeImage
     */
    public function synchronizeAll(bool $synchronizeImage = false): void
    {
        parent::synchronizeAll($synchronizeImage);
    }

    /**
     * @param bool $reloadImage
     */
    public function reload(bool $reloadImage = false): void
    {
        $this->clear($reloadImage);
        $this->synchronizeAll($reloadImage);
    }

    /**
     * @param bool $clearImage
     */
    public function clear(bool $clearImage = false): void
    {
        parent::clear($clearImage);
    }

    /**
     *
     */
    public function updatePriceAll(): void
    {
        parent::updatePriceAll();
    }

    /**
     * @param string $ids
     */
    public function updatePriceByIds(string $ids): void
    {
        parent::updatePriceByIds($ids);
    }

    /**
     * @param string $ids
     */
    public function updatePriceByCategoryIds(string $ids): void
    {
        parent::updatePriceByCategoryIds($ids);
    }

    /**
     * @param string $ids
     */
    public function updatePriceByIdsFast(string $ids): void
    {
        parent::updatePriceByIdsFast($ids);
    }

    /**
     *
     */
    public function updatePriceAllFast(): void
    {
        parent::updatePriceAllFast();
    }
}