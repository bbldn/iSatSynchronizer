<?php

namespace App\Contract\BackToFront;

use App\Entity\Back\OrderGamePost as OrderBack;

interface OrderSynchronizerHelperContract
{
    /**
     * @param OrderBack $mainOrderBack
     * @return int|null
     */
    public function getCustomerFrontByCustomerBackId(OrderBack $mainOrderBack): ?int;
}