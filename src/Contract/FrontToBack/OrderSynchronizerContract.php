<?php

namespace App\Contract\FrontToBack;

use App\Contract\CanLoadInterface;
use App\Contract\CanReloadInterface;

interface OrderSynchronizerContract extends CanLoadInterface, CanReloadInterface
{
    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void;
}