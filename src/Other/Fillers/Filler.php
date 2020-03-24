<?php

namespace App\Other\Fillers;

class Filler
{
    public static function securityString(?string $value)
    {
        return (null === $value) ? ' ' : $value;
    }
}