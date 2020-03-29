<?php

namespace App\Service\Synchronizer\FrontToBack;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Customer;
use App\Entity\Front\Customer as CustomerFront;
use App\Exception\CustomerFrontNotFoundException;
use App\Other\Back\Store as StoreBack;
use App\Other\Fillers\CustomerFiller;
use App\Repository\Back\BuyersGamePostRepository as CustomerBackRepository;
use App\Repository\CustomerRepository;
use App\Repository\Front\AddressRepository as AddressRepositoryFront;
use App\Repository\Front\CustomerRepository as CustomerFrontRepository;

class CustomerSynchronizer
{
    protected $storeBack;
    protected $addressRepositoryFront;
    protected $customerFrontRepository;
    protected $customerBackRepository;
    protected $customerRepository;

    public function __construct(
        StoreBack $storeBack,
        AddressRepositoryFront $addressRepositoryFront,
        CustomerFrontRepository $customerFrontRepository,
        CustomerBackRepository $customerBackRepository,
        CustomerRepository $customerRepository
    )
    {
        $this->storeBack = $storeBack;
        $this->addressRepositoryFront = $addressRepositoryFront;
        $this->customerFrontRepository = $customerFrontRepository;
        $this->customerBackRepository = $customerBackRepository;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param int $id
     * @throws CustomerFrontNotFoundException
     */
    public function synchronizeOne(int $id): void
    {
        $customerFront = $this->customerFrontRepository->find($id);

        if (null === $customerFront) {
            throw new CustomerFrontNotFoundException();
        }

        $this->synchronizeCustomer($customerFront);
    }

    /**
     *
     */
    public function synchronizeAll(): void
    {
        $customersFront = $this->customerFrontRepository->findAll();
        foreach ($customersFront as $customerFront) {
            $this->synchronizeCustomer($customerFront);
        }
    }

    /**
     * @param CustomerFront $customerFront
     */
    protected function synchronizeCustomer(CustomerFront $customerFront): void
    {
        $customer = $this->customerRepository->findOneByFrontId($customerFront->getCustomerId());
        $customerBack = $this->getCustomerBackFromCustomer($customer);
        $this->updateCustomerBackFromCustomerFront($customerFront, $customerBack);
        $this->createOrUpdateCustomer($customer, $customerBack->getId(), $customerFront->getCustomerId());
    }

    /**
     * @param Customer|null $customer
     * @return CustomerBack
     */
    protected function getCustomerBackFromCustomer(?Customer $customer): CustomerBack
    {
        if (null === $customer) {
            return new CustomerBack();
        }

        $customerBack = $this->customerBackRepository->find($customer->getBackId());

        if (null === $customerBack) {
            return new CustomerBack();
        }

        return $customerBack;
    }

    /**
     * @param CustomerFront $customerFront
     * @param CustomerBack $customerBack
     * @return CustomerBack
     */
    protected function updateCustomerBackFromCustomerFront(
        CustomerFront $customerFront,
        CustomerBack $customerBack
    ): CustomerBack
    {
        $addressFront = $this->addressRepositoryFront->find($customerFront->getAddressId());
        CustomerFiller::frontToBack($customerBack, $customerFront, $addressFront);

        return $customerBack;
    }

    /**
     * @param Customer|null $customer
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
        $this->customerRepository->saveAndFlush($customer);
    }
}