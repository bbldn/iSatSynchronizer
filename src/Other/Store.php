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

    public static function convertBackToFrontCurrency(string $currency): string
    {
        switch (mb_strtolower(trim($currency))) {
            case 'uah':
            case 'ua':
                return 'грн';
            case 'rub':
            case 'ru':
                return 'р';
            case 'usd':
                return '$';
            case 'eur':
                return '€';
            default:
                return '';
        }
    }

    public static function convertFrontToBackCurrency(string $currency): array
    {
        switch (mb_strtolower(trim($currency))) {
            case 'грн':
                return ['code' => 'UAH', 'id' => 4];
            case 'р':
                return ['code' => 'RUB', 'id' => 1];
            case '$':
                return ['code' => 'USD', 'id' => 2];
            default:
                return ['code' => 'UAH', 'id' => 4];
        }
    }

    public static function convertBackToFrontStatusOrder(int $value): int
    {
        return $value;
    }

    public static function parseLogin(?string $value): ?string
    {
        if (null === $value) {
            return null;
        }

        $arr = [];
        preg_match('/^[^@]+/', $value, $arr);

        if (0 === count($arr)) {
            return $value;
        }

        return $arr[1];
    }
}