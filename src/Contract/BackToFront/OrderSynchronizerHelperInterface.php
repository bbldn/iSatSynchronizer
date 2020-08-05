<?php

namespace App\Contract\BackToFront;

use App\Entity\Back\OrderGamePost as OrderBack;

interface OrderSynchronizerHelperInterface
{
    /**
     * @param OrderBack $mainOrderBack
     * @return int|null
     */
    public function getCustomerFrontByCustomerBackId(OrderBack $mainOrderBack): ?int;
}