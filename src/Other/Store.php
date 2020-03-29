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

    public static function encodingConvert(?string $value)
    {
        if (null === $value) {
            return $value;
        }

        $encoding = mb_strtolower(mb_detect_encoding($value));

        if ('utf-8' === $encoding) {
            return $value;
        }

        return mb_convert_encoding($value, 'utf-8', $encoding);
    }
}