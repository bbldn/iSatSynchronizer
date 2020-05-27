<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Customer;
use App\Entity\Front\Customer as CustomerFront;
use App\Helper\Filler;
use App\Helper\Front\Store as StoreFront;
use App\Repository\Back\BuyersGamePostRepository as CustomerBackRepository;
use App\Repository\CustomerRepository;
use App\Repository\Front\AddressRepository as AddressFrontRepository;
use App\Repository\Front\CustomerRepository as CustomerFrontRepository;
use App\Service\Synchronizer\BackToFront\AddressSynchronizer;
use Illuminate\Support\Str;
use Psr\Log\LoggerInterface;

class CustomerSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var AddressSynchronizer $addressSynchronizer */
    protected $addressSynchronizer;

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
     * @param LoggerInterface $logger
     * @param StoreFront $storeFront
     * @param AddressSynchronizer $addressSynchronizer
     * @param CustomerRepository $customerRepository
     * @param AddressFrontRepository $addressFrontRepository
     * @param CustomerFrontRepository $customerFrontRepository
     * @param CustomerBackRepository $customerBackRepository
     */
    public function __construct(
        LoggerInterface $logger,
        StoreFront $storeFront,
        AddressSynchronizer $addressSynchronizer,
        CustomerRepository $customerRepository,
        AddressFrontRepository $addressFrontRepository,
        CustomerFrontRepository $customerFrontRepository,
        CustomerBackRepository $customerBackRepository
    )
    {
        $this->logger = $logger;
        $this->storeFront = $storeFront;
        $this->addressSynchronizer = $addressSynchronizer;
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
        $this->customerRepository->resetAutoIncrements();
        $this->customerFrontRepository->resetAutoIncrements();

        $this->addressSynchronizer->clear();
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
        $addressFront = $this->addressSynchronizer->synchronizeByCustomerBack($customerBack);

        $saul = $customerFront->getSalt();
        if (null === $saul) {
            $saul = Str::random($this->saulLength);
        }

        $customerFront->setCustomerGroupId($this->storeFront->getDefaultCustomerGroupId());
        $customerFront->setStoreId($this->storeFront->getDefaultStoreId());
        $customerFront->setLanguageId($this->storeFront->getDefaultLanguageId());
        $customerFront->setFirstName($addressFront->getFirstName());
        $customerFront->setLastName($addressFront->getLastName());
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