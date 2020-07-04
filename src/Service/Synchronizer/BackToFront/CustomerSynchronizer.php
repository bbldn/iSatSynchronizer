<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Front\Customer as CustomerFront;
use App\Service\Synchronizer\BackToFront\Implementation\CustomerSynchronizer as CustomerBaseSynchronizer;

class CustomerSynchronizer extends CustomerBaseSynchronizer
{
    /**
     * @return CustomerSynchronizer
     */
    public function load(): self
    {
        parent::load();

        return $this;
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
    public function clear(): void
    {
        parent::clear();
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
     * @param int $customerBackId
     * @return CustomerFront|null
     */
    public function synchronizeOneAndReturnCustomerFront(int $customerBackId): ?CustomerFront
    {
        $customerBack = $this->customerBackRepository->find($customerBackId);
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