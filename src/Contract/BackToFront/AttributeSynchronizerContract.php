<?php

namespace App\Contract\BackToFront;

interface AttributeSynchronizerContract
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
    public function synchronizeById(string $ids): void;

    /**
     *
     */
    public function clear(): void;

    /**
     *
     */
    public function reload(): void;
}