<?php

namespace App\Helper;

class PaymentConverter
{
    /**
     * @param int $id
     * @return string
     */
    public static function backToFront(int $id): string
    {
        switch ($id) {
            case 3: //Оплата картой Visa/MasterCard
                return 'visa.mastercart';
            case 5: //Оплата через LiqPay
                return 'liqpay';
            case 7: //Оплата при получении
                return 'cod';
            case 11: //Оплата на карту Приватбанка
                return 'privatbank';
            case 13: //Оплата курьеру наличными
                return 'cash';
            case 14: //WebMoney
                return 'webmoney';
            case 15: //Оплата на карту ПУМБ
                return 'pumb';
            case 4: //Оплата в офисе
            default:
                return 'cod';
        }
    }

    /**
     * @param string $name
     * @return int
     */
    public static function frontToBack(string $name): int
    {
        switch ($name) {
            case 'visa.mastercart': //Оплата картой Visa/MasterCard
                return 3;
            case 'liqpay': //Оплата через LiqPay
                return 5;
            case 'privatbank': //Оплата на карту Приватбанка
                return 11;
            case 'cash': //Оплата курьеру наличными
                return 13;
            case 'webmoney': //WebMoney
                return 14;
            case 'pumb': //Оплата на карту ПУМБ
                return 15;
            case 'cod': //Оплата при получении
            default:
                return 4;
        }
    }
}