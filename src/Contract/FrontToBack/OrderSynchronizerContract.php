<?php

namespace App\Contract\FrontToBack;

interface OrderSynchronizerContract
{
    /**
     *
     */
    public function load(): void;

    /**
     *
     */
    public function synchronizeAll(): void;

    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void;

    /**
     *
     */
    public function clear(): void;
}