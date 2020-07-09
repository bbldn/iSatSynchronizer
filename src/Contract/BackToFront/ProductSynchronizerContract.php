<?php

namespace App\Contract\BackToFront;

interface ProductSynchronizerContract
{
    /**
     *
     */
    public function load(): void;

    /**
     * @param string $ids
     * @param bool $synchronizeImage
     */
    public function synchronizeByIds(string $ids, bool $synchronizeImage = false): void;

    /**
     * @param int $id
     * @param bool $synchronizeImage
     */
    public function synchronizeByCategoryId(int $id, bool $synchronizeImage = false): void;

    /**
     * @param string $name
     * @param bool $synchronizeImage
     */
    public function synchronizeByName(string $name, bool $synchronizeImage = false): void;

    /**
     * @param bool $synchronizeImage
     */
    public function synchronizeAll(bool $synchronizeImage = false): void;

    /**
     * @param bool $reloadImage
     */
    public function reload(bool $reloadImage = false): void;

    /**
     * @param bool $clearImage
     */
    public function clear(bool $clearImage = false): void;

    /**
     *
     */
    public function synchronizePriceAll(): void;

    /**
     * @param string $ids
     */
    public function synchronizePriceByIds(string $ids): void;

    /**
     * @param string $ids
     */
    public function synchronizePriceByCategoryIds(string $ids): void;

    /**
     * @param string $ids
     */
    public function synchronizePriceByIdsFast(string $ids): void;

    /**
     *
     */
    public function synchronizePriceAllFast(): void;
}