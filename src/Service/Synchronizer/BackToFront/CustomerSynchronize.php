<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Front\Address as AddressFront;
use App\Entity\Front\Customer as CustomerFront;
use App\Other\Fillers\AddressFiller;
use App\Other\Fillers\CustomerFiller;
use App\Other\Fillers\Filler;
use App\Other\Store;
use App\Repository\Front\AddressRepository as AddressFrontRepository;
use App\Repository\Front\CustomerRepository as CustomerFrontRepository;

class CustomerSynchronize
{
    protected $store;
    protected $addressRepository;
    protected $customerRepository;

    public function __construct(Store $store,
                                AddressFrontRepository $addressRepository,
                                CustomerFrontRepository $customerRepository)
    {
        $this->store = $store;
        $this->addressRepository = $addressRepository;
        $this->customerRepository = $customerRepository;
    }

    protected function synchronizeCustomer(CustomerBack $customerBack)
    {
        $firstName = ' ';
        $lastName = ' ';

        $fullName = explode(' ', $customerBack->getFio());
        if (count($fullName) > 1) {
            $lastName = trim($fullName[0]);
            $firstName = trim($fullName[1]);
        } elseif (count($fullName) == 1) {
            $lastName = trim($fullName[0]);
        }

        $addressFront = new AddressFront();

        AddressFiller::backToFront(
            $addressFront,
            $firstName,
            $lastName,
            trim($customerBack->getStreet() . ' ' . $customerBack->getHouse()),
            trim($customerBack->getCity())
        );

        $saul = '';
        $customerFront = new CustomerFront();
        CustomerFiller::backToFront(
            $customerFront,
            $customerBack,
            $this->store->getDefaultShop(),
            $this->store->getDefaultLanguageId(),
            $addressFront->getAddressId(),
            $this->store->hashPassword($customerBack->getPassword(), $saul),
            $saul
        );

        $this->customerRepository->saveAndFlush($customerFront);
        $addressFront->setCustomerId($customerFront->getCustomerId());
        $this->addressRepository->saveAndFlush($addressFront);
    }
}