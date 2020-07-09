<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;
use App\Contract\CanReload;

interface AttributeSynchronizerContract extends CanLoadInterface, CanReload
{
    /**
     * @param string $ids
     */
    public function synchronizeById(string $ids): void;
}