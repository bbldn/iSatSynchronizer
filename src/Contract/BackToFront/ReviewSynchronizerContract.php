<?php

namespace App\Contract\BackToFront;

interface ReviewSynchronizerContract
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

    /**
     *
     */
    public function reload(): void;
}