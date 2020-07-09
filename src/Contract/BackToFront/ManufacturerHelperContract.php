<?php

namespace App\Contract\BackToFront;

interface ManufacturerHelperContract
{
    /**
     * @param string $productName
     * @return int
     */
    public function getManufacturerId(string $productName): int;
}