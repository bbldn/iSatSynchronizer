<?php

namespace App\Other\Fillers;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Front\Customer as CustomerFront;

class CustomerFiller
{
    public static function backToFront(CustomerFront $customerFront,
                                       CustomerBack $customerBack,
                                       int $storeId,
                                       int $languageId,
                                       int $addressId,
                                       string $password,
                                       string $salt): CustomerFront
    {
        $customerFront->setCustomerGroupId(1);
        $customerFront->setStoreId($storeId);
        $customerFront->setLanguageId($languageId);

        $firstName = ' ';
        $lastName = ' ';

        $fullName = explode(' ', $customerBack->getFio());
        if (count($fullName) > 1) {
            $lastName = trim($fullName[0]);
            $firstName = trim($fullName[1]);
        } elseif (count($fullName) == 1) {
            $lastName = trim($fullName[0]);
        }

        $customerFront->setFirstName($firstName);
        $customerFront->setLastName($lastName);
        $customerFront->setFax(Filler::securityString(null));
        $customerFront->setPassword($password);
        $customerFront->setSalt($salt);
        $customerFront->setCart(null);
        $customerFront->setWishList(null);
        $customerFront->setNewsletter(false);

        $customerFront->setAddressId($addressId);
        $customerFront->setCustomField(Filler::securityString(null));
        $customerFront->setIp(Filler::securityString(null));
        $customerFront->setStatus(true);
        $customerFront->setSafe(false);
        $customerFront->setCode(Filler::securityString(null));

        return $customerFront;
    }
}