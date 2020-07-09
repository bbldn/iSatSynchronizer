<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Contract\BackToFront\AddressSynchronizerHelperContract;
use App\Entity\Address;
use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Front\Address as AddressFront;
use App\Helper\Back\Store as StoreBack;
use App\Helper\Filler;
use App\Helper\Front\Store as StoreFront;
use App\Repository\AddressRepository;
use App\Repository\Back\BuyersGamePostRepository as CustomerBackRepository;
use App\Repository\CustomerRepository;
use App\Repository\Front\AddressRepository as AddressFrontRepository;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;

abstract class AddressSynchronizer extends BackToFrontSynchronizer
{
    /** @var AddressSynchronizerHelperContract $addressSynchronizerHelper */
    protected $addressSynchronizerHelper;

    /** @var CustomerBackRepository $customerBackRepository */
    protected $customerBackRepository;

    /** @var CustomerRepository $customerRepository */
    protected $customerRepository;

    /** @var AddressFrontRepository $addressFrontRepository */
    protected $addressFrontRepository;

    /** @var AddressRepository $addressRepository */
    protected $addressRepository;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /**
     * AddressSynchronizer constructor.
     * @param AddressSynchronizerHelperContract $addressSynchronizerHelper
     * @param CustomerBackRepository $customerBackRepository
     * @param CustomerRepository $customerRepository
     * @param AddressFrontRepository $addressFrontRepository
     * @param AddressRepository $addressRepository
     * @param StoreFront $storeFront
     */
    public function __construct(
        AddressSynchronizerHelperContract $addressSynchronizerHelper,
        CustomerBackRepository $customerBackRepository,
        CustomerRepository $customerRepository,
        AddressFrontRepository $addressFrontRepository,
        AddressRepository $addressRepository,
        StoreFront $storeFront
    )
    {
        $this->addressSynchronizerHelper = $addressSynchronizerHelper;
        $this->customerBackRepository = $customerBackRepository;
        $this->customerRepository = $customerRepository;
        $this->addressFrontRepository = $addressFrontRepository;
        $this->addressRepository = $addressRepository;
        $this->storeFront = $storeFront;
    }

    /**
     * @param Address|null $address
     * @return AddressFront|null
     */
    public function getAddressFrontFromAddress(?Address $address): ?AddressFront
    {
        if (null === $address) {
            return new AddressFront();
        }

        $addressFront = $this->addressFrontRepository->find($address->getFrontId());
        if (null === $addressFront) {
            $addressFront = new AddressFront();
        }

        return $addressFront;
    }

    /**
     * @param Address|null $address
     * @param int $customerBackId
     * @param int $frontId
     * @return Address
     */
    public function createOrUpdateAddress(?Address $address, int $customerBackId, int $frontId): Address
    {
        if (null === $address) {
            $address = new Address();
        }

        $address->setCustomerBackId($customerBackId);
        $address->setFrontId($frontId);

        $this->addressRepository->persistAndFlush($address);

        return $address;
    }

    /**
     * @param CustomerBack $customerBack
     * @param AddressFront $addressFront
     * @return AddressFront
     */
    public function updateAddressFrontFromCustomerBack(
        CustomerBack $customerBack,
        AddressFront $addressFront
    ): AddressFront
    {
        if (null === $addressFront->getCustomerId()) {
            $customerFrontId = $this->addressSynchronizerHelper->getCustomerFrontIdByCustomerBack($customerBack);
            $addressFront->setCustomerId($customerFrontId);
        }

        $fullName = StoreBack::parseFirstLastName($customerBack->getFio());

        $addressFront->setFirstName($fullName['firstName']);
        $addressFront->setLastName($fullName['lastName']);
        $addressFront->setCompany(Filler::securityString(null));
        $address = trim("{$customerBack->getStreet()} {$customerBack->getHouse()}");
        $addressFront->setAddress1($address);
        $addressFront->setAddress2($address);
        $addressFront->setCity(trim($customerBack->getCity()));
        $addressFront->setPostCode(Filler::securityString(null));
        $addressFront->setCountryId($this->storeFront->getDefaultCountryId());
        $addressFront->setZoneId($this->storeFront->getDefaultZoneId());
        $addressFront->setCustomField(Filler::securityString(null));
        $this->addressFrontRepository->persistAndFlush($addressFront);

        return $addressFront;
    }

    /**
     * @param CustomerBack $customerBack
     * @return AddressFront
     */
    public function synchronizeByCustomerBack(CustomerBack $customerBack): AddressFront
    {
        $address = $this->addressRepository->findOneByOrderBackId($customerBack->getId());
        $addressFront = $this->getAddressFrontFromAddress($address);
        $this->updateAddressFrontFromCustomerBack($customerBack, $addressFront);
        $this->createOrUpdateAddress($address, $customerBack->getId(), $addressFront->getAddressId());

        return $addressFront;
    }
}