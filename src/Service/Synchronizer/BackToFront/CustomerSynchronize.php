<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Customer;
use App\Entity\Front\Address as AddressFront;
use App\Entity\Front\Customer as CustomerFront;
use App\Exception\CustomerBackNotFoundException;
use App\Other\Back\Store as StoreBack;
use App\Other\Fillers\AddressFiller;
use App\Other\Fillers\CustomerFiller;
use App\Other\Front\Store as StoreFront;
use App\Repository\AddressRepository;
use App\Repository\Back\BuyersGamePostRepository as CustomerBackRepository;
use App\Repository\CustomerRepository;
use App\Repository\Front\AddressRepository as AddressFrontRepository;
use App\Repository\Front\CustomerRepository as CustomerFrontRepository;
use Illuminate\Support\Str;

class CustomerSynchronize
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
    public function clear(): void
    {
        $this->customerFrontRepository->removeAll();
        $this->addressFrontRepository->removeAll();
        $this->addressRepository->removeAll();

        $this->customerFrontRepository->resetAutoIncrements();
        $this->addressFrontRepository->resetAutoIncrements();
        $this->addressRepository->resetAutoIncrements();
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
            $this->storeFront->getDefaultShop(),
            $this->storeFront->getDefaultLanguageId(),
            $addressFront->getAddressId(),
            StoreFront::hashPassword($customerBack->getPassword(), $saul),
            $saul
        );

        $this->customerFrontRepository->saveAndFlush($customerFront);
        $addressFront->setCustomerId($customerFront->getCustomerId());
        $this->addressFrontRepository->saveAndFlush($addressFront);

        return $customerFront;
    }

    /**
     * @param Customer $customer
     * @param int $backId
     * @param int $frontId
     * @return Customer
     */
    protected function createOrUpdateCustomer(Customer $customer, int $backId, int $frontId): Customer
    {
        if (null === $customer) {
            $customer = new Customer();
        }
        $customer->setBackId($backId);
        $customer->setFrontId($frontId);
        $this->customerRepository->saveAndFlush($customer);
    }

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