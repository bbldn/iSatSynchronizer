<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Front\Address as AddressFront;
use App\Service\Synchronizer\BackToFront\Implementation\AddressSynchronizer as AddressBaseSynchronizer;

class AddressSynchronizer extends AddressBaseSynchronizer
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

    /**
     *
     */
    public function clear(): void
    {
        parent::clear();
    }
}