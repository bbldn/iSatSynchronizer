<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Customer;
use App\Entity\Front\Address as AddressFront;
use App\Entity\Front\Customer as CustomerFront;
use App\Helper\Back\Store as StoreBack;
use App\Helper\Filler;
use App\Helper\Front\Store as StoreFront;
use App\Repository\AddressRepository;
use App\Repository\Back\BuyersGamePostRepository as CustomerBackRepository;
use App\Repository\CustomerRepository;
use App\Repository\Front\AddressRepository as AddressFrontRepository;
use App\Repository\Front\CustomerRepository as CustomerFrontRepository;
use Illuminate\Support\Str;

class CustomerSynchronizer
{
    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var StoreBack $storeBack */
    protected $storeBack;

    /** @var AddressRepository $addressRepository */
    protected $addressRepository;

    /** @var CustomerRepository $customerRepository */
    protected $customerRepository;

    /** @var AddressFrontRepository $addressFrontRepository */
    protected $addressFrontRepository;

    /** @var CustomerFrontRepository $customerFrontRepository */
    protected $customerFrontRepository;

    /** @var CustomerBackRepository $customerBackRepository */
    protected $customerBackRepository;

    /** @var int $saulLength */
    protected $saulLength = 9;

    /**
     * CustomerSynchronizer constructor.
     * @param StoreFront $storeFront
     * @param StoreBack $storeBack
     * @param AddressRepository $addressRepository
     * @param CustomerRepository $customerRepository
     * @param AddressFrontRepository $addressFrontRepository
     * @param CustomerFrontRepository $customerFrontRepository
     * @param CustomerBackRepository $customerBackRepository
     */
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

        $addressFront->setCustomerId(0);
        $addressFront->setFirstName($fullName['firstName']);
        $addressFront->setLastName($fullName['lastName']);
        $addressFront->setCompany(Filler::securityString(null));
        $addressFront->setAddress1(trim($customerBack->getStreet() . ' ' . $customerBack->getHouse()));
        $addressFront->setAddress2(Filler::securityString(null));
        $addressFront->setCity(trim($customerBack->getCity()));
        $addressFront->setPostCode(Filler::securityString(null));
        $addressFront->setCountryId($this->storeFront->getDefaultCountryId());
        $addressFront->setZoneId(3490);
        $addressFront->setCustomField(Filler::securityString(null));

        $this->addressFrontRepository->persistAndFlush($addressFront);

        $saul = $customerFront->getSalt();
        if (null === $saul) {
            $saul = Str::random($this->saulLength);
        }

        $customerFront->setCustomerGroupId($this->storeFront->getDefaultCustomerGroupId());
        $customerFront->setStoreId($this->storeFront->getDefaultStoreId());
        $customerFront->setLanguageId($this->storeFront->getDefaultLanguageId());
        $customerFront->setFirstName($fullName['firstName']);
        $customerFront->setLastName($fullName['lastName']);
        $customerFront->setEmail($customerBack->getMail());
        $customerFront->setTelephone($customerBack->getPhone());
        $customerFront->setFax(Filler::securityString(null));
        $customerFront->setPassword(StoreFront::hashPassword($customerBack->getPassword(), $saul));
        $customerFront->setSalt($saul);
        $customerFront->setCart(null);
        $customerFront->setWishList(null);
        $customerFront->setNewsletter(false);
        $customerFront->setAddressId($addressFront->getAddressId());
        $customerFront->setCustomField($this->storeFront->getDefaultCustomField());
        $customerFront->setIp(Filler::securityString(null));
        $customerFront->setStatus($customerBack->getActive());
        $customerFront->setSafe(false);
        $customerFront->setToken(Filler::securityString(null));
        $customerFront->setCode(Filler::securityString(null));

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