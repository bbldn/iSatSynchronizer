<?php

namespace App\Contract\BackToFront;

use App\Entity\Back\BuyersGamePost as CustomerBack;

interface AddressSynchronizerHelperInterface
{
    /**
     * @param CustomerBack $customerBack
     * @return int
     */
    public function getCustomerFrontIdByCustomerBack(CustomerBack $customerBack): int;
}