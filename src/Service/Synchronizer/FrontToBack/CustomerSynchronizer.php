<?php

namespace App\Service\Synchronizer\FrontToBack;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Customer;
use App\Entity\Front\Customer as CustomerFront;
use App\Exception\CustomerFrontNotFoundException;
use App\Other\Back\Store as StoreBack;
use App\Other\Filler;
use App\Other\Store;
use App\Repository\Back\BuyersGamePostRepository as CustomerBackRepository;
use App\Repository\CustomerRepository;
use App\Repository\Front\AddressRepository as AddressRepositoryFront;
use App\Repository\Front\CustomerRepository as CustomerFrontRepository;
use Illuminate\Support\Str;

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

        if (null === $addressFront) {
            $city = $addressFront->getCity();
            $street = $addressFront->getAddress1();
        } else {
            $city = Filler::securityString(null);
            $street = Filler::securityString(null);
        }

        $time = time();

        $customerBack->fill(
            Filler::securityString(Store::parseLogin($customerFront->getEmail())),
            base64_decode($customerFront->getPass()),
            $customerFront->getLastName() . ' ' . $customerFront->getFirstName(),
            $customerFront->getTelephone(),
            Filler::securityString(null),
            $city,
            $street,
            Filler::securityString(null),
            $customerFront->getEmail(),
            Str::lower(Str::random(32)),
            true,
            false,
            $time,
            $time,
            $time,
            '0',
            Filler::securityString(null),
            Filler::securityString(null),
            Filler::securityString(null),
            Filler::securityString(null),
            Filler::securityString(null),
            Filler::securityString(null),
            '006084',
            $this->storeBack->getDefaultMoneyReal(),
            $this->storeBack->getDefaultMoneyVirtual(),
            $this->storeBack->getDefaultMoneyBox(),
            new \DateTime(),
            $this->storeBack->getDefaultReferer(),
            $this->storeBack->getDefaultGroupId(),
            $this->storeBack->getDefaultGroupExtraId(),
            $this->storeBack->getDefaultShopId(),
            Filler::securityString(null),
            $this->storeBack->getDefaultDelivery(),
            $this->storeBack->getDefaultPayment(),
            Filler::securityString(null)
        );

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