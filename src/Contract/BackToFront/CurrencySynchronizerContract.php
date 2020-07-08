<?php

namespace App\Contract\BackToFront;

interface CurrencySynchronizerContract
{
    /**
     *
     */
    public function load(): void;

    /**
     *
     */
    public function synchronizeAll(): void;
}