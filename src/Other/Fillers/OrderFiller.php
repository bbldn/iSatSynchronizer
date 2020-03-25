<?php

namespace App\Other\Fillers;

use App\Entity\Back\OrderGamePost as OrderBack;
use App\Entity\Front\Order as OrderFront;
use App\Entity\Front\OrderProduct as OrderProductFront;

class OrderFiller
{
    /**
     * @param OrderFront $orderFront
     * @param OrderProductFront $orderProductFront
     * @param int $backId
     * @param string $backCurrency
     * @param string $parentName
     * @param int $status
     * @param int $clientId
     * @param int $defaultShop
     * @param string $currencyValueWhenPurchasing
     * @param int $orderNum
     * @param OrderBack $orderBack
     * @return OrderBack
     */
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
        $orderBack->setHouse(Filler::securityString(null));
        $orderBack->setWarehouse(Filler::securityString(null));
        $orderBack->setMail($orderFront->getEmail());
        $orderBack->setWhant('');
        $orderBack->setVipNum(Filler::securityString(null));
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

        $orderBack->setTrackNumber(Filler::securityString(null));
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
        $orderBack->setShippingCurrencyName(Filler::securityString(null));
        $orderBack->setShippingCurrencyValue(0);

        return $orderBack;
    }
}