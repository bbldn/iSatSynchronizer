<?php

namespace App\Helper;

class Store
{
    /**
     * @param float $value
     * @param float $course
     * @return float
     */
    public static function convertToCurrency(float $value, float $course = 0)
    {
        if (0 === $course) {
            return round($value);
        }

        return round($value / $course);
    }

    /**
     * @param string|null $value
     * @return string[]|string|null
     */
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

    /**
     * @param string $currency
     * @return string
     */
    public static function convertFrontToBackCurrency(string $currency): string
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

    /**
     * @param string $currency
     * @return array
     */
    public static function convertBackToFrontCurrency(string $currency): array
    {
        switch (mb_strtolower(trim($currency))) {
            case 'грн':
            case '₴':
                return ['code' => 'UAH', 'id' => 2];
            case 'р':
                return ['code' => 'RUB', 'id' => 3];
            case '$':
            default:
                return ['code' => 'USD', 'id' => 1];
        }
    }

    /**
     * @param int $value
     * @return int
     */
    public static function convertBackToFrontStatusOrder(int $value): int
    {
        return $value;
    }

    /**
     * @param string|null $value
     * @return string|null
     */
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

        return $arr[0];
    }

    /**
     * @param string $phone
     * @return string
     */
    public static function normalizePhone(string $phone): string
    {
        $phone = preg_replace('/[-() ]/i', '', $phone);
        $matches = [];
        if (0 === preg_match('/\+?3?8?0?([0-9]{9})/i', $phone, $matches)) {
            return '380' . $phone;
        }

        return '380' . $matches[1];
    }
}