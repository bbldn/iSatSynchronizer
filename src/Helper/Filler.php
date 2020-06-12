<?php

namespace App\Helper;

class Filler
{
    /**
     * @param string|null $value
     * @return string
     */
    public static function securityString(?string $value)
    {
        return (null === $value) ? ' ' : $value;
    }
}