<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;
use App\Contract\CanReloadInterface;
use App\Entity\Front\Customer as CustomerFront;

interface CustomerSynchronizerInterface extends CanLoadInterface, CanReloadInterface
{
    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void;

    /**
     * @param int $customerBackId
     * @return CustomerFront|null
     */
    public function synchronizeOneAndReturnCustomerFront(int $customerBackId): ?CustomerFront;
}