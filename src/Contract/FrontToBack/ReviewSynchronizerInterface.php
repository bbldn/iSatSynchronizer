<?php

namespace App\Contract\FrontToBack;

use App\Contract\CanLoadInterface;
use App\Contract\CanSynchronizeAll;

interface ReviewSynchronizerInterface extends CanLoadInterface, CanSynchronizeAll
{
    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void;
}