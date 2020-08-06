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
use App\Repository\Front\OrderRepository as OrderFrontRepository;
use App\Service\Synchronizer\BackToFront\AddressSynchronizer;
use Illuminate\Support\Str;
use Psr\Log\LoggerInterface;
use App\Helper\Back\Store as StoreBack;
use Symfony\Component\String\ByteString;

abstract class CustomerSynchronizer extends BackToFrontSynchronizer
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

    /** @var OrderFrontRepository $orderFrontRepository */
    protected $orderFrontRepository;

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
     * @param OrderFrontRepository $orderFrontRepository
     */
    public function __construct(
        LoggerInterface $logger,
        StoreFront $storeFront,
        AddressSynchronizer $addressSynchronizer,
        CustomerRepository $customerRepository,
        AddressFrontRepository $addressFrontRepository,
        CustomerFrontRepository $customerFrontRepository,
        CustomerBackRepository $customerBackRepository,
        OrderFrontRepository $orderFrontRepository
    )
    {
        $this->logger = $logger;
        $this->storeFront = $storeFront;
        $this->addressSynchronizer = $addressSynchronizer;
        $this->customerRepository = $customerRepository;
        $this->addressFrontRepository = $addressFrontRepository;
        $this->customerFrontRepository = $customerFrontRepository;
        $this->customerBackRepository = $customerBackRepository;
        $this->orderFrontRepository = $orderFrontRepository;
    }

    /**
     * @param CustomerBack $customerBack
     * @return CustomerFront
     */
    protected function synchronizeCustomer(CustomerBack $customerBack): CustomerFront
    {
        $email = Filler::trim($customerBack->getMail());
        $customer = $this->customerRepository->findOneByBackId($customerBack->getId());
        $customerFront = $this->getCustomerFrontFromCustomer($customer, mb_strlen($email) > 0 ? $email : null);
        $this->updateCustomerFrontFromCustomerBack($customerBack, $customerFront);
        $this->createOrUpdateCustomer($customer, $customerBack->getId(), $customerFront->getCustomerId());

        return $customerFront;
    }

    /**
     * @param Customer|null $customer
     * @param string|null $email
     * @return CustomerFront
     */
    protected function getCustomerFrontFromCustomer(?Customer $customer, ?string $email = null): CustomerFront
    {
        if (null !== $customer) {
            $customerFront = $this->customerFrontRepository->find($customer->getFrontId());
            if (null !== $customerFront) {
                return $customerFront;
            }
        }

        if (null !== $email) {
            $customerFront = $this->customerFrontRepository->findOneByEmail($email);
            if (null !== $customerFront) {
                return $customerFront;
            }
        }

        return new CustomerFront();
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
        $saul = $customerFront->getSalt();
        if (null === $saul) {
            $saul = ByteString::fromRandom($this->saulLength)->toString();
        }

        $parsedFIO = StoreBack::parseFirstLastName($customerBack->getFio());

        if (0 === $customerBack->getGroupId()) {
            $customerFront->setCustomerGroupId($this->storeFront->getDefaultCustomerGroupId());
        } else {
            $customerFront->setCustomerGroupId($customerBack->getGroupId());
        }

        $customerFront->setStoreId($this->storeFront->getDefaultStoreId());
        $customerFront->setLanguageId($this->storeFront->getDefaultLanguageId());
        $customerFront->setFirstName($parsedFIO['firstName']);
        $customerFront->setLastName($parsedFIO['lastName']);
        $customerFront->setEmail($customerBack->getMail());
        $customerFront->setTelephone($customerBack->getPhone());
        $customerFront->setFax(Filler::securityString(null));

        if (null === $customerFront->getPassword()) {
            $customerFront->setPassword(StoreFront::hashPassword($customerBack->getPassword(), $saul));
        }

        $customerFront->setSalt($saul);
        if (null === $customerFront->getCart()) {
            $customerFront->setCart(null);
        }

        if (null === $customerFront->getWishList()) {
            $customerFront->setWishList(null);
        }

        if (null === $customerFront->getNewsletter()) {
            $customerFront->setNewsletter(false);
        }

        if (null === $customerFront->getAddressId()) {
            $customerFront->setAddressId(0);
        }

        $customerFront->setCustomField(Filler::trim(null));

        if (null === $customerFront->getIp()) {
            $ip = null;
            if (null !== $customerFront->getCustomerId()) {
                $orderFrontLast = $this->orderFrontRepository->findOneLastByCustomerId($customerFront->getCustomerId());
                if (null !== $orderFrontLast) {
                    $ip = $orderFrontLast->getIp();
                }
            }

            $customerFront->setIp(Filler::securityString($ip));
        }

        $customerFront->setStatus($customerBack->getActive());
        $customerFront->setSafe(false);

        if (null === $customerFront->getToken()) {
            $customerFront->setToken(Filler::securityString(null));
        }

        if (null === $customerFront->getCode()) {
            $customerFront->setCode(Filler::securityString(null));
        }

        $this->customerFrontRepository->persistAndFlush($customerFront);

        return $customerFront;
    }

    /**
     * @param Customer $customer
     * @param int $backId
     * @param int $frontId
     * @return Customer
     */
    protected function createOrUpdateCustomer(?Customer $customer, int $backId, int $frontId): Customer
    {
        if (null === $customer) {
            $customer = new Customer();
        }

        $customer->setBackId($backId);
        $customer->setFrontId($frontId);

        $this->customerRepository->persistAndFlush($customer);

        return $customer;
    }
}