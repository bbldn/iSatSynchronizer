<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;
use App\Contract\CanReload;
use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Front\Address as AddressFront;

interface AddressSynchronizerContract extends CanLoadInterface, CanReload
{
    /**
     * @param CustomerBack $customerBack
     * @return AddressFront
     */
    public function synchronizeByCustomerBack(CustomerBack $customerBack): AddressFront;
}