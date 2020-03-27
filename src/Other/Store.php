<?php

namespace App\Other;

class Store
{
    public static function convertToCurrency(float $value, float $course = 0)
    {
        if (0 === $course) {
            return round($value);
        }

        return round($value / $course);
    }
}