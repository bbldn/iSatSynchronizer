<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;
use App\Contract\CanReloadInterface;

interface AttributeSynchronizerContract extends CanLoadInterface, CanReloadInterface
{
    /**
     * @param string $ids
     */
    public function synchronizeById(string $ids): void;
}