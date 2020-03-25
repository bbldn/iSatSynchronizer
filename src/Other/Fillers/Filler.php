<?php

namespace App\Other\Fillers;

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