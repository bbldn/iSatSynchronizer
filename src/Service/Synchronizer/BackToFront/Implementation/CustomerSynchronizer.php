<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Customer;
use App\Entity\Front\Address as AddressFront;
use App\Entity\Front\Customer as CustomerFront;
use App\Other\Back\Store as StoreBack;
use App\Other\Filler;
use App\Other\Front\Store as StoreFront;
use App\Repository\AddressRepository;
use App\Repository\Back\BuyersGamePostRepository as CustomerBackRepository;
use App\Repository\CustomerRepository;
use App\Repository\Front\AddressRepository as AddressFrontRepository;
use App\Repository\Front\CustomerRepository as CustomerFrontRepository;
use Illuminate\Support\Str;

class CustomerSynchronizer
{
    protected $storeFront;
    protected $storeBack;
    protected $addressRepository;
    protected $customerRepository;
    protected $addressFrontRepository;
    protected $customerFrontRepository;
    protected $customerBackRepository;
    protected $saulLength = 9;

    public function __construct(
        StoreFront $storeFront,
        StoreBack $storeBack,
        AddressRepository $addressRepository,
        CustomerRepository $customerRepository,
        AddressFrontRepository $addressFrontRepository,
        CustomerFrontRepository $customerFrontRepository,
        CustomerBackRepository $customerBackRepository
    )
    {
        $this->storeFront = $storeFront;
        $this->storeBack = $storeBack;
        $this->addressRepository = $addressRepository;
        $this->customerRepository = $customerRepository;
        $this->addressFrontRepository = $addressFrontRepository;
        $this->customerFrontRepository = $customerFrontRepository;
        $this->customerBackRepository = $customerBackRepository;
    }

    /**
     *
     */
    protected function clear(): void
    {
        $this->customerRepository->removeAll();
        $this->customerFrontRepository->removeAll();
        $this->addressFrontRepository->removeAll();
        $this->addressRepository->removeAll();

        $this->customerRepository->resetAutoIncrements();
        $this->customerFrontRepository->resetAutoIncrements();
        $this->addressFrontRepository->resetAutoIncrements();
        $this->addressRepository->resetAutoIncrements();
    }

    /**
     * @param CustomerBack $customerBack
     */
    protected function synchronizeCustomer(CustomerBack $customerBack): void
    {
        $customer = $this->customerRepository->findOneByBackId($customerBack->getId());
        $customerFront = $this->getCustomerFrontFromCustomer($customer);
        $this->updateCustomerFrontFromCustomerBack($customerBack, $customerFront);
        $this->createOrUpdateCustomer($customer, $customerBack->getId(), $customerFront->getCustomerId());
    }

    /**
     * @param Customer|null $customer
     * @return CustomerFront
     */
    protected function getCustomerFrontFromCustomer(?Customer $customer): CustomerFront
    {
        if (null === $customer) {
            return new CustomerFront();
        }

        $customerFront = $this->customerFrontRepository->find($customer->getFrontId());

        if (null === $customerFront) {
            return new CustomerFront();
        }

        return $customerFront;
    }

    /**
     * @param CustomerBack $customerBack
     * @param CustomerFront $customerFront
     * @return CustomerFront
     */
    protected function updateCustomerFrontFromCustomerBack(
        CustomerBack $customerBack,
        CustomerFront $customerFront
    ): CustomerFront
    {
        $address = $this->addressRepository->findOneByOrderBackId($customerBack->getId());
        $addressFront = null;

        if (null === $address) {
            $addressFront = new AddressFront();
        } else {
            $addressFront = $this->addressFrontRepository->find($address->getFrontId());
            if (null === $addressFront) {
                $addressFront = new AddressFront();
            }
        }

        $fullName = $this->parseFirstLastName($customerBack->getFio());
        $addressFront->fill(
            0,
            $fullName['firstName'],
            $fullName['lastName'],
            Filler::securityString(null),
            trim($customerBack->getStreet() . ' ' . $customerBack->getHouse()),
            Filler::securityString(null),
            trim($customerBack->getCity()),
            Filler::securityString(null),
            $this->storeFront->getDefaultCountryId(),
            3490,
            Filler::securityString(null)
        );
        $this->addressFrontRepository->persistAndFlush($addressFront);

        $saul = $customerFront->getSalt();
        if (null === $saul) {
            $saul = Str::random($this->saulLength);
        }

        $customerFront->fill(
            $this->storeFront->getDefaultCustomerGroupId(),
            $this->storeFront->getDefaultStoreId(),
            $this->storeFront->getDefaultLanguageId(),
            $fullName['firstName'],
            $fullName['lastName'],
            $customerBack->getMail(),
            $customerBack->getPhone(),
            Filler::securityString(null),
            StoreFront::hashPassword($customerBack->getPassword(), $saul),
            $saul,
            null,
            null,
            false,
            $addressFront->getAddressId(),
            $this->storeFront->getDefaultCustomField(),
            Filler::securityString(null),
            $customerBack->getActive(),
            false,
            Filler::securityString(null),
            Filler::securityString(null),
            base64_encode($customerBack->getPassword())
        );

        $this->customerFrontRepository->persistAndFlush($customerFront);
        $addressFront->setCustomerId($customerFront->getCustomerId());
        $this->addressFrontRepository->persistAndFlush($addressFront);

        return $customerFront;
    }

    /**
     * @param string $fio
     * @return array
     */
    protected function parseFirstLastName(string $fio): array
    {
        $result = [
            'firstName' => ' ',
            'lastName' => ' ',
        ];

        $fullName = explode(' ', $fio);
        if (count($fullName) > 1) {
            $result['lastName'] = trim($fullName[0]);
            $result['firstName'] = trim($fullName[1]);
        } elseif (count($fullName) == 1) {
            $result['lastName'] = trim($fullName[0]);
        }

        return $result;
    }

    /**
     * @param Customer $customer
     * @param int $backId
     * @param int $frontId
     */
    protected function createOrUpdateCustomer(?Customer $customer, int $backId, int $frontId)
    {
        if (null === $customer) {
            $customer = new Customer();
        }
        $customer->setBackId($backId);
        $customer->setFrontId($frontId);
        $this->customerRepository->persistAndFlush($customer);
    }
}