<?php

namespace App\Contract;

interface AgsatProductsCacheLoaderInterface
{
    /**
     * @return array
     */
    public function load(): array;
}