<?php

namespace App\Contract\BackToFront;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Front\Address as AddressFront;

interface AddressSynchronizerContract
{
    /**
     *
     */
    public function load(): void;

    /**
     *
     */
    public function synchronizeAll(): void;

    /**
     * @param CustomerBack $customerBack
     * @return AddressFront
     */
    public function synchronizeByCustomerBack(CustomerBack $customerBack): AddressFront;

    /**
     *
     */
    public function clear(): void;
}