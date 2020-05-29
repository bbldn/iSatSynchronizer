<?php

namespace App\Helper;

class ShippingConverter
{
    /**
     * @param int $id
     * @return string
     */
    public static function backToFront(int $id): string
    {
        switch ($id) {
            case 31: //Инлайн
                return 'intime.intime';
            //Те которые есть на фронте
            case 23: //Самовывоз
                return 'pickup.pickup';
            case 30: //Новая почта
                return 'novaposhta.novaposhta';
            case 32: //Деливери
                return 'delivery.delivery';
            //end
            case 33: //Гюнсел
                return 'guncel.guncel';
            case 34: //Автолюкс
                return 'autolux.autolux';
            case 35: //Курьерская доставка по Донецку
                return 'donetsk.donetsk';
            case 21:
            default: //Индивидуальное
                return 'individual.individual';
        }
    }

    /**
     * @param string $name
     * @return int
     */
    public static function frontToBack(string $name): int
    {
        switch ($name) {
            case 'intime.intime': //Инлайн
                return 31;
            case 'pickup.pickup': //Самовывоз
                return 23;
            case 'novaposhta.novaposhta': //Новая почта
                return 30;
            case 'delivery.delivery': //Деливери
                return 32;
            case 'guncel.guncel': //Гюнсел
                return 33;
            case 'autolux.autolux': //Автолюкс
                return 34;
            case 'donetsk.donetsk': //Курьерская доставка по Донецку
                return 35;
            case 'individual.individual': //Индивидуальное
            default:
                return 21;
        }
    }
}