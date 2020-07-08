<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\CustomerSynchronizerContract;
use App\Entity\Front\Customer as CustomerFront;
use App\Service\Synchronizer\BackToFront\Implementation\CustomerSynchronizer as CustomerBaseSynchronizer;

class CustomerSynchronizer extends CustomerBaseSynchronizer implements CustomerSynchronizerContract
{
    /**
     *
     */
    public function load(): void
    {
        parent::load();
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
        $this->customerRepository->removeAll();
        $this->customerFrontRepository->removeAll();
        $this->customerRepository->resetAutoIncrements();
        $this->customerFrontRepository->resetAutoIncrements();

        $this->addressSynchronizer->clear();
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