<?php

namespace App\Service\Synchronizer\FrontToBack\Implementation;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Customer;
use App\Entity\Front\Customer as CustomerFront;
use App\Entity\Front\Order as OrderFront;
use App\Helper\Back\Store as StoreBack;
use App\Helper\Filler;
use App\Helper\Store;
use App\Repository\Back\BuyersGamePostRepository as CustomerBackRepository;
use App\Repository\CustomerRepository;
use App\Repository\Front\AddressRepository as AddressRepositoryFront;
use App\Repository\Front\CustomerRepository as CustomerFrontRepository;
use App\Service\Synchronizer\FrontToBack\FrontToBackSynchronizer;
use DateTime;
use Illuminate\Support\Str;
use Psr\Log\LoggerInterface;

class CustomerSynchronizer extends FrontToBackSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var StoreBack $storeBack */
    protected $storeBack;

    /** @var AddressRepositoryFront $addressRepositoryFront */
    protected $addressRepositoryFront;

    /** @var CustomerFrontRepository $customerFrontRepository */
    protected $customerFrontRepository;

    /** @var CustomerBackRepository $customerBackRepository */
    protected $customerBackRepository;

    /** @var CustomerRepository $customerRepository */
    protected $customerRepository;

    /**
     * CustomerSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param StoreBack $storeBack
     * @param AddressRepositoryFront $addressRepositoryFront
     * @param CustomerFrontRepository $customerFrontRepository
     * @param CustomerBackRepository $customerBackRepository
     * @param CustomerRepository $customerRepository
     */
    public function __construct(
        LoggerInterface $logger,
        StoreBack $storeBack,
        AddressRepositoryFront $addressRepositoryFront,
        CustomerFrontRepository $customerFrontRepository,
        CustomerBackRepository $customerBackRepository,
        CustomerRepository $customerRepository
    )
    {
        $this->logger = $logger;
        $this->storeBack = $storeBack;
        $this->addressRepositoryFront = $addressRepositoryFront;
        $this->customerFrontRepository = $customerFrontRepository;
        $this->customerBackRepository = $customerBackRepository;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param OrderFront $orderFront
     * @param CustomerBack $customerBack
     * @return CustomerBack
     */
    public function updateCustomerBackFromOrderFront(
        OrderFront $orderFront,
        CustomerBack $customerBack
    ): CustomerBack
    {
        $time = time();

        $customerBack->setLogin(Filler::securityString(Store::parseLogin($orderFront->getEmail())));
        $customerBack->setPassword(rand(100000, 999999));
        $customerBack->setFio($orderFront->getLastName() . ' ' . $orderFront->getFirstName());
        $customerBack->setPhone(Store::normalizePhone($orderFront->getTelephone()));
        $customerBack->setRegion(Filler::securityString(null));
        $customerBack->setCity($orderFront->getShippingCity());
        $customerBack->setStreet($orderFront->getShippingAddress1());
        $customerBack->setHouse(Filler::securityString(null));
        $customerBack->setMail($orderFront->getEmail());
        $customerBack->setCode(Str::lower(Str::random(32)));
        $customerBack->setActive(true);
        $customerBack->setAccount(false);
        $customerBack->setDateReg($time);
        $customerBack->setDateAccBegin($time);
        $customerBack->setDateAccEnd($time);
        $customerBack->setVip('0');
        $customerBack->setImageSmall(Filler::securityString(null));
        $customerBack->setImageBig(Filler::securityString(null));
        $customerBack->setInfo(Filler::securityString(null));
        $customerBack->setIp(Filler::securityString(null));
        $customerBack->setTimestampOnline(Filler::securityString(null));
        $customerBack->setTimestampActive(Filler::securityString(null));
        $customerBack->setChatNameColor('006084');
        $customerBack->setMoneyReal($this->storeBack->getDefaultMoneyReal());
        $customerBack->setMoneyVirtual($this->storeBack->getDefaultMoneyVirtual());
        $customerBack->setMoneyBox($this->storeBack->getDefaultMoneyBox());
        $customerBack->setDateBirth(new DateTime('0000-00-00 00:00:00'));
        $customerBack->setReferer($this->storeBack->getDefaultReferer());
        $customerBack->setGroupId($this->storeBack->getDefaultGroupId());
        $customerBack->setGroupExtraId($this->storeBack->getDefaultGroupExtraId());
        $customerBack->setShopId($this->storeBack->getDefaultShopId());
        $customerBack->setComment(Filler::securityString(null));
        $customerBack->setDelivery($this->storeBack->getDefaultDelivery());
        $customerBack->setPayment($this->storeBack->getDefaultPayment());
        $customerBack->setWarehouse(Filler::securityString(null));

        $this->customerBackRepository->persistAndFlush($customerBack);

        return $customerBack;
    }

    /**
     * @param CustomerFront $customerFront
     * @param string $password
     * @return CustomerBack
     */
    protected function synchronizeCustomer(CustomerFront $customerFront, string $password): CustomerBack
    {
        $customer = $this->customerRepository->findOneByFrontId($customerFront->getCustomerId());
        $customerBack = $this->getCustomerBackFromCustomer($customer);
        $this->updateCustomerBackFromCustomerFront($customerFront, $customerBack, $password);
        $this->createOrUpdateCustomer($customer, $customerBack->getId(), $customerFront->getCustomerId());

        return $customerBack;
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
     * @param string $password
     * @return CustomerBack
     */
    protected function updateCustomerBackFromCustomerFront(
        CustomerFront $customerFront,
        CustomerBack $customerBack,
        string $password
    ): CustomerBack
    {
        $addressFront = $this->addressRepositoryFront->find($customerFront->getAddressId());

        if (null !== $addressFront) {
            $city = $addressFront->getCity();
            $street = $addressFront->getAddress1();
        } else {
            $city = Filler::securityString(null);
            $street = Filler::securityString(null);
        }

        $time = time();
        if (null === $customerBack->getLogin()) {
            $customerBack->setLogin(Filler::securityString(Store::parseLogin($customerFront->getEmail())));
        }

        $customerBack->setPassword($password);

        if (null === $customerBack->getFio()) {
            $customerBack->setFio($customerFront->getLastName() . ' ' . $customerFront->getFirstName());
        }

        $customerBack->setPhone(Store::normalizePhone($customerFront->getTelephone()));
        $customerBack->setRegion(Filler::securityString(null));
        $customerBack->setCity($city);
        $customerBack->setStreet($street);
        $customerBack->setHouse(Filler::securityString(null));
        $customerBack->setMail($customerFront->getEmail());
        $customerBack->setCode(Str::lower(Str::random(32)));
        $customerBack->setActive(true);
        $customerBack->setAccount(false);
        $customerBack->setDateReg($time);
        $customerBack->setDateAccBegin($time);
        $customerBack->setDateAccEnd($time);
        $customerBack->setVip('0');
        $customerBack->setImageSmall(Filler::securityString(null));
        $customerBack->setImageBig(Filler::securityString(null));
        $customerBack->setInfo(Filler::securityString(null));
        $customerBack->setIp(Filler::securityString(null));
        $customerBack->setTimestampOnline(Filler::securityString(null));
        $customerBack->setTimestampActive(Filler::securityString(null));
        $customerBack->setChatNameColor('006084');
        $customerBack->setMoneyReal($this->storeBack->getDefaultMoneyReal());
        $customerBack->setMoneyVirtual($this->storeBack->getDefaultMoneyVirtual());
        $customerBack->setMoneyBox($this->storeBack->getDefaultMoneyBox());
        $customerBack->setDateBirth(new DateTime('0000-00-00 00:00:00'));
        $customerBack->setReferer($this->storeBack->getDefaultReferer());
        $customerBack->setGroupId($this->storeBack->getDefaultGroupId());
        $customerBack->setGroupExtraId($this->storeBack->getDefaultGroupExtraId());
        $customerBack->setShopId($this->storeBack->getDefaultShopId());
        $customerBack->setComment('');
        $customerBack->setDelivery($this->storeBack->getDefaultDelivery());
        $customerBack->setPayment($this->storeBack->getDefaultPayment());
        $customerBack->setWarehouse(Filler::securityString(null));

        $this->customerBackRepository->persistAndFlush($customerBack);

        return $customerBack;
    }

    /**
     * @param Customer|null $customer
     * @param int $backId
     * @param int $frontId
     */
    protected function createOrUpdateCustomer(?Customer $customer, int $backId, int $frontId): void
    {
        if (null === $customer) {
            $customer = new Customer();
        }

        $customer->setBackId($backId);
        $customer->setFrontId($frontId);

        $this->customerRepository->persistAndFlush($customer);
    }
}