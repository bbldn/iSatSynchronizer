<?php

namespace App\Contract\BackToFront;

interface ProductDiscountSpeedSynchronizerInterface extends ProductDiscountSynchronizerInterface
{
    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void;
}