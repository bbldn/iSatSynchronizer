<?php

namespace App\Other\Fillers;

use App\Entity\Front\Address as AddressFront;

class AddressFiller
{
    public static function backToFront(AddressFront $addressFront,
                                       string $firstName,
                                       string $lastName,
                                       string $address1,
                                       string $city)
    {
        $addressFront->setCustomerId(0);
        $addressFront->setFirstName($firstName);
        $addressFront->setLastName($lastName);
        $addressFront->setCompany(Filler::securityString(null));
        $addressFront->setAddress1($address1);
        $addressFront->setAddress2(Filler::securityString(null));
        $addressFront->setCity($city);
        $addressFront->setPostCode(Filler::securityString(null));
        $addressFront->setCountryId(220);
        $addressFront->setZoneId(3490);
        $addressFront->setCustomField(Filler::securityString(null));
    }
}