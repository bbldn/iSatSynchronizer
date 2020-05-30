<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Front\Customer as CustomerFront;
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
    public function clear(): void
    {
        parent::clear();
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

    /**
     * @param int $customerId
     * @return CustomerFront|null
     */
    public function synchronizeOneAndReturnCustomerFront(int $customerId): ?CustomerFront
    {
        $customerBack = $this->customerBackRepository->find($customerId);
        if (null === $customerBack) {
            return null;
        }

        $customerFront = $this->synchronizeCustomer($customerBack);
        if (null === $customerFront) {
            return null;
        }

        if (null === $customerFront->getCustomerId()) {
            return null;
        }

        return $customerFront;
    }
}