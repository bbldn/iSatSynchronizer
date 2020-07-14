<?php

namespace App\Contract;

interface CanReloadInterface extends CanClearInterface, CanSynchronizeAll
{
    /**
     *
     */
    public function reload(): void;
}