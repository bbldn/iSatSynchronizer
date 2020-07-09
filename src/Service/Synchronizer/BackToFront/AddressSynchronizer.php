<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\AddressSynchronizerContract;
use App\Service\Synchronizer\BackToFront\Implementation\AddressSynchronizer as AddressBaseSynchronizer;

class AddressSynchronizer extends AddressBaseSynchronizer implements AddressSynchronizerContract
{
    /**
     *
     */
    public function synchronizeAll(): void
    {
        $customersBack = $this->customerBackRepository->findAll();
        foreach ($customersBack as $customerBack) {
            $this->synchronizeByCustomerBack($customerBack);
        }
    }

    /**
     *
     */
    public function clear(): void
    {
        $this->addressFrontRepository->removeAll();
        $this->addressFrontRepository->resetAutoIncrements();
    }
}