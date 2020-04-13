<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Service\Synchronizer\BackToFront\Implementation\CustomerSynchronizer as CustomerBaseSynchronizer;

class CustomerSynchronizer extends CustomerBaseSynchronizer
{
    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void
    {
        $customersBack = $this->customerBackRepository->findByIds($ids);
        foreach ($customersBack as $customerBack) {
            $this->synchronizeCustomer($customerBack);
        }
    }

    /**
     *
     */
    public function reload(): void
    {
        $this->clear();
        $this->synchronizeAll();
    }

    /**
     *
     */
    public function synchronizeAll(): void
    {
        $customersBack = $this->customerBackRepository->findAll();
        foreach ($customersBack as $customerBack) {
            $this->synchronizeCustomer($customerBack);
        }
    }
}