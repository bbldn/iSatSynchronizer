<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Contract\BackToFront\AddressSynchronizerContract;
use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Front\Address as AddressFront;
use App\Service\Synchronizer\BackToFront\Implementation\AddressSynchronizer as AddressBaseSynchronizer;

class AddressSynchronizer extends AddressBaseSynchronizer implements AddressSynchronizerContract
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

    /**
     *
     */
    public function reload(): void
    {
        $this->clear();
        $this->synchronizeAll();
    }

    /**
     * @param CustomerBack $customerBack
     * @return AddressFront
     */
    public function synchronizeByCustomerBack(CustomerBack $customerBack): AddressFront
    {
        $address = $this->addressRepository->findOneByOrderBackId($customerBack->getId());
        $addressFront = $this->getAddressFrontFromAddress($address);
        $this->updateAddressFrontFromCustomerBack($customerBack, $addressFront);
        $this->createOrUpdateAddress($address, $customerBack->getId(), $addressFront->getAddressId());

        return $addressFront;
    }
}