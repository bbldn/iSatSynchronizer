<?php

namespace App\Contract;

interface CanReload extends CanClear, CanSynchronizeAll
{
    /**
     *
     */
    public function reload(): void;
}