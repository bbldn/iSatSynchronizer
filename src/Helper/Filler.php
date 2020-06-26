<?php

namespace App\Helper;

class Filler
{
    /**
     * @param string|null $value
     * @return string
     */
    public static function securityString(?string $value): string
    {
        return (null === $value) ? ' ' : $value;
    }

    /**
     * @param null|string $value
     * @return string
     */
    public static function trim(?string $value): string
    {
        return trim($value);
    }
}