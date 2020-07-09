<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;
use App\Contract\CanReload;

interface OrderSynchronizerContract extends CanLoadInterface, CanReload
{
    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void;
}