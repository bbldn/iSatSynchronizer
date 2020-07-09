<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;

interface ManufacturerHelperContract extends CanLoadInterface
{
    /**
     * @param string $productName
     * @return int
     */
    public function getManufacturerId(string $productName): int;

    /**
     *
     */
    public function load(): void;
}