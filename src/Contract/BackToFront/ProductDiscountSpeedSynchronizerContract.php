<?php

namespace App\Contract\BackToFront;

interface ProductDiscountSpeedSynchronizerContract extends ProductDiscountSynchronizerContract
{
    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void;
}