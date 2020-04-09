<?php

namespace App\Other;

class Filler
{
    /**
     * @param null|string $value
     * @return null|string
     */
    public static function securityString(?string $value)
    {
        return (null === $value) ? ' ' : $value;
    }
}