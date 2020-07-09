<?php

namespace App\Contract\BackToFront;

interface ProductDiscountSynchronizerContract
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
     * @param int $productBackId
     */
    public function synchronizeByProductBackId(int $productBackId): void;

    /**
     * @param int $productId
     */
    public function createOrUpdateDiscountItems(int $productId): void;

    /**
     *
     */
    public function clear(): void;
}