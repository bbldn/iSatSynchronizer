<?php

namespace App\Other\Fillers;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Front\Customer as CustomerFront;
use App\Entity\Front\Address as AddressFront;
use Illuminate\Support\Str;

class CustomerFiller
{
    public static function frontToBack(
        CustomerBack $customerBack,
        CustomerFront $customerFront,
        ?AddressFront $addressFront
    ): CustomerBack
    {
        $customerBack->setLogin(Filler::securityString(static::parseLogin($customerFront->getEmail())));
        $customerBack->setPassword(base64_decode($customerFront->getPass()));
        $customerBack->setFio($customerFront->getLastName() . ' ' . $customerFront->getFirstName());
        $customerBack->setPhone($customerFront->getTelephone());
        $customerBack->setRegion(Filler::securityString(null));

        if (null === $addressFront) {
            $customerBack->setCity($addressFront->getCity());
            $customerBack->setStreet($addressFront->getAddress1());
        } else {
            $customerBack->setCity(Filler::securityString(null));
            $customerBack->setStreet(Filler::securityString(null));
        }

        $customerBack->setHouse(Filler::securityString(null));
        $customerBack->setMail($customerFront->getEmail());
        $customerBack->setCode(Str::lower(Str::random(32)));
        $customerBack->setActive(true);
        $customerBack->setAccount(false);
        $time = time();
        $customerBack->setDateReg($time);
        $customerBack->setDateAccBegin($time);
        $customerBack->setDateAccEnd($time);

        $customerBack->setVip('0');
        $customerBack->setImageSmall(Filler::securityString(null));
        $customerBack->setImageBig(Filler::securityString(null));
        $customerBack->setIp(Filler::securityString(null));
        $customerBack->setTimestampOnline(Filler::securityString(null));
        $customerBack->setTimestampActive(Filler::securityString(null));
        $customerBack->setChatNameColor('006084');
        $customerBack->setMoneyReal(0);
        $customerBack->setMoneyVirtual(0);
        $customerBack->setDateBirth(new \DateTime());
        $customerBack->setReferer(0);
        $customerBack->setGroupId(2);
        $customerBack->setGroupExtraId(1);
        $customerBack->setShopId(1);
        $customerBack->setComment(Filler::securityString(null));
        $customerBack->setDelivery(0);
        $customerBack->setPayment(0);
        $customerBack->setWarehouse(Filler::securityString(null));

        return $customerBack;
    }

    protected static function parseLogin(?string $value): ?string
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