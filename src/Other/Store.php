<?php

namespace App\Other;

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
     * @param null|string $value
     * @return null|string|string[]
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

    /**
     * @param string $currency
     * @return array
     */
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

    /**
     * @param int $value
     * @return int
     */
    public static function convertBackToFrontStatusOrder(int $value): int
    {
        return $value;
    }

    /**
     * @param null|string $value
     * @return null|string
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
        if (null === preg_match('/\+?3?8?0?([0-9]{9})/i', $phone, $matches)) {
            return $phone;
        }

        return '+380' . $matches[1];
    }
}