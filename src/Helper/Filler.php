<?php

namespace App\Helper;

class Filler
{
    /**
     * @param string|null $value
     * @return string|null
     */
    public static function securityString(?string $value)
    {
        return (null === $value) ? ' ' : $value;
    }
}