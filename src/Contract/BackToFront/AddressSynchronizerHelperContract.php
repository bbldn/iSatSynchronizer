<?php

namespace App\Contract\BackToFront;

use App\Entity\Back\BuyersGamePost as CustomerBack;

interface AddressSynchronizerHelperContract
{
    /**
     * @param CustomerBack $customerBack
     * @return int
     */
    public function getCustomerFrontIdByCustomerBack(CustomerBack $customerBack): int;
}