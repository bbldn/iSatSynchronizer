<?php

namespace App\Contract\BackToFront;

use App\Entity\Front\Customer as CustomerFront;

interface CustomerSynchronizerContract
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
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void;

    /**
     *
     */
    public function clear(): void;

    /**
     *
     */
    public function reload(): void;

    /**
     * @param int $customerBackId
     * @return CustomerFront|null
     */
    public function synchronizeOneAndReturnCustomerFront(int $customerBackId): ?CustomerFront;
}