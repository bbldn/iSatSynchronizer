<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Customer;
use App\Entity\Front\Address as AddressFront;
use App\Entity\Front\Customer as CustomerFront;
use App\Exception\CustomerBackNotFoundException;
use App\Other\Fillers\AddressFiller;
use App\Other\Fillers\CustomerFiller;
use App\Other\Store;
use App\Repository\AddressRepository;
use App\Repository\Back\BuyersGamePostRepository as CustomerBackRepository;
use App\Repository\CustomerRepository;
use App\Repository\Front\AddressRepository as AddressFrontRepository;
use App\Repository\Front\CustomerRepository as CustomerFrontRepository;
use Illuminate\Support\Str;

class CustomerSynchronize
{
    protected $store;
    protected $addressRepository;
    protected $customerRepository;
    protected $addressFrontRepository;
    protected $customerFrontRepository;
    protected $customerBackRepository;
    protected $saulLength = 9;

    public function __construct(Store $store,
                                AddressRepository $addressRepository,
                                CustomerRepository $customerRepository,
                                AddressFrontRepository $addressFrontRepository,
                                CustomerFrontRepository $customerFrontRepository,
                                CustomerBackRepository $customerBackRepository)
    {
        $this->store = $store;
        $this->addressRepository = $addressRepository;
        $this->customerRepository = $customerRepository;
        $this->addressFrontRepository = $addressFrontRepository;
        $this->customerFrontRepository = $customerFrontRepository;
        $this->customerBackRepository = $customerBackRepository;
    }

    /**
     * @param int $id
     * @throws CustomerBackNotFoundException
     */
    public function synchronizeOne(int $id): void
    {
        $customerBack = $this->customerBackRepository->find($id);
        if (null === $customerBack) {
            throw new CustomerBackNotFoundException();
        }

        $this->synchronizeCustomer($customerBack);
    }

    public function synchronizeAll(): void
    {
        $customersBack = $this->customerBackRepository->findAll();

        foreach ($customersBack as $customerBack) {
            $this->synchronizeCustomer($customerBack);
        }
    }

    protected function synchronizeCustomer(CustomerBack $customerBack): void
    {
        $customer = $this->customerRepository->findOneByBackId($customerBack->getId());
        if (null === $customer) {
            $customerFront = $this->createCustomerFrontFromCustomerBack($customerBack);
            $this->createCustomer($customerBack->getId(), $customerFront->getCustomerId());
        } else {
            $customerFront = $this->customerFrontRepository->find($customer->getFrontId());
            if (null === $customerFront) {
                $customerFront = $this->createCustomerFrontFromCustomerBack($customerBack);
                $this->createCustomer($customerBack->getId(), $customerFront->getCustomerId());
            } else {
                $this->updateCustomerFrontFromCustomerBack($customerBack, $customerFront);
                $this->customerRepository->saveAndFlush($customerFront);
            }
        }
    }

    protected function createCustomerFrontFromCustomerBack(CustomerBack $customerBack): CustomerFront
    {
        $fullName = $this->parseFirstLastName($customerBack->getFio());

        $addressFront = new AddressFront();

        AddressFiller::backToFront(
            $addressFront,
            $fullName['firstName'],
            $fullName['lastName'],
            trim($customerBack->getStreet() . ' ' . $customerBack->getHouse()),
            trim($customerBack->getCity())
        );

        $saul = Str::random($this->saulLength);
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

        $this->customerFrontRepository->saveAndFlush($customerFront);
        $addressFront->setCustomerId($customerFront->getCustomerId());
        $this->addressFrontRepository->saveAndFlush($addressFront);

        return $customerFront;
    }

    /**
     * @param CustomerBack $customerBack
     * @param CustomerFront $customerFront
     */
    protected function updateCustomerFrontFromCustomerBack(CustomerBack $customerBack, CustomerFront $customerFront): void
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
        AddressFiller::backToFront(
            $addressFront,
            $fullName['firstName'],
            $fullName['lastName'],
            trim($customerBack->getStreet() . ' ' . $customerBack->getHouse()),
            trim($customerBack->getCity())
        );

        $saul = $customerFront->getSalt();
        if (null === $saul) {
            $saul = Str::random($this->saulLength);
        }

        CustomerFiller::backToFront(
            $customerFront,
            $customerBack,
            $this->store->getDefaultShop(),
            $this->store->getDefaultLanguageId(),
            $addressFront->getAddressId(),
            $this->store->hashPassword($customerBack->getPassword(), $saul),
            $saul
        );

        $this->customerFrontRepository->saveAndFlush($customerFront);
        $addressFront->setCustomerId($customerFront->getCustomerId());
        $this->addressFrontRepository->saveAndFlush($addressFront);
    }

    /**
     * @param int $backId
     * @param int $frontId
     * @return Customer
     */
    protected function createCustomer(int $backId, int $frontId): Customer
    {
        $customer = new Customer();
        $customer->setBackId($backId);
        $customer->setFrontId($frontId);
        $this->customerRepository->saveAndFlush($customer);

        return $customer;
    }

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
}