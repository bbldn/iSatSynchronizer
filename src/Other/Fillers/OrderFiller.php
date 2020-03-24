<?php

namespace App\Other\Fillers;

use App\Entity\Back\OrderGamePost as OrderBack;
use App\Entity\Front\Order as OrderFront;
use App\Entity\Front\OrderProduct as OrderProductFront;

class OrderFiller extends Filler
{
    public static function frontToBack(OrderFront $orderFront,
                                       OrderProductFront $orderProductFront,
                                       int $backId,
                                       string $backCurrency,
                                       string $parentName,
                                       int $status,
                                       int $clientId,
                                       int $defaultShop,
                                       string $currencyValueWhenPurchasing,
                                       int $orderNum,
                                       OrderBack $orderBack)
    {
        $orderBack->setType('Покупка');
        $orderBack->setProductName($orderProductFront->getName());
        $orderBack->setProductId($backId);
        $orderBack->setPrice($orderProductFront->getPrice());
        $orderBack->setAmount($orderProductFront->getQuantity());
        $orderBack->setCurrencyName($backCurrency);
        $orderBack->setParentName($parentName);
        $orderBack->setPhone($orderFront->getTelephone());
        $orderBack->setFio($orderFront->getLastName() . ' ' . $orderFront->getFirstName());
        $orderBack->setRegion($orderFront->getShippingZone());
        $orderBack->setCity($orderFront->getShippingCity());
        $orderBack->setStreet($orderFront->getShippingAddress1());
        $orderBack->setHouse('');
        $orderBack->setWarehouse('');
        $orderBack->setMail($orderFront->getEmail());
        $orderBack->setWhant('');
        $orderBack->setVipNum('');
        $orderBack->setStatus($status);
        $orderBack->setComments($orderFront->getComment());
        $orderBack->setArchive(0);
        $orderBack->setRead(0);
        $orderBack->setSynchronize(0);

        $orderBack->setClientId($clientId);
        $orderBack->setPayment(13);

        //TODO Пока так потом надо будет писать решение
        $orderBack->setDelivery(21);

        $orderBack->setOrderNum($orderNum);

        $orderBack->setTrackNumber('');
        $orderBack->setTrackNumberDate(new \DateTime());
        $orderBack->setMoneyGiven(0);
        $orderBack->setTrackSent(0);
        $orderBack->setSerialNum('');
        $orderBack->setShopId($defaultShop);
        $orderBack->setShopIdCounterparty(0);
        $orderBack->setPaymentWaitDays(0);
        $orderBack->setPaymentWaitFirstSum(0);
        $orderBack->setPaymentDate(new \DateTime());
        $orderBack->setDocumentId(0);
        $orderBack->setDocumentType(2);
        $orderBack->setInvoiceSent(new \DateTime());

        //TODO Разобраться с курсом для разных валют
        $orderBack->setCurrencyValue(1);
        $orderBack->setCurrencyValueWhenPurchasing($currencyValueWhenPurchasing);


        $orderBack->setShippingPrice(0);
        $orderBack->setShippingPriceOld(0);
        $orderBack->setShippingCurrencyName('');
        $orderBack->setShippingCurrencyValue(0);

        return $orderBack;
    }
}