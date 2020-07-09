<?php

namespace App\Contract\BackToFront;

interface DescriptionHelperContract
{
    /**
     *
     */
    public function load(): void;

    /**
     * @param null|string $text
     * @return string
     */
    public function synchronize(?string $text): string;

    /**
     *
     */
    public function clearFolder(): void;
}