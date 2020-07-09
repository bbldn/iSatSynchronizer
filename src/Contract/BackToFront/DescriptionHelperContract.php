<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;

interface DescriptionHelperContract extends CanLoadInterface
{

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