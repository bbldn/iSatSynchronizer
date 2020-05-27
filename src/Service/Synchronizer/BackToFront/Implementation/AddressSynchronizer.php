<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Address;
use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Front\Address as AddressFront;
use App\Helper\Filler;
use App\Helper\Front\Store as StoreFront;
use App\Repository\AddressRepository;
use App\Repository\Back\BuyersGamePostRepository as CustomerBackRepository;
use App\Repository\Front\AddressRepository as AddressFrontRepository;

class AddressSynchronizer
{
    /** @var CustomerBackRepository $customerBackRepository */
    protected $customerBackRepository;

    /** @var AddressFrontRepository $addressFrontRepository */
    protected $addressFrontRepository;

    /** @var AddressRepository $addressRepository */
    protected $addressRepository;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /**
     * AddressSynchronizer constructor.
     * @param CustomerBackRepository $customerBackRepository
     * @param AddressFrontRepository $addressFrontRepository
     * @param AddressRepository $addressRepository
     * @param StoreFront $storeFront
     */
    public function __construct(
        CustomerBackRepository $customerBackRepository,
        AddressFrontRepository $addressFrontRepository,
        AddressRepository $addressRepository,
        StoreFront $storeFront
    )
    {
        $this->customerBackRepository = $customerBackRepository;
        $this->addressFrontRepository = $addressFrontRepository;
        $this->addressRepository = $addressRepository;
        $this->storeFront = $storeFront;
    }

    /**
     * @param Address|null $address
     * @return AddressFront|null
     */
    protected function getAddressFrontFromAddress(?Address $address)
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
     */
    protected function createOrUpdateAddress(?Address $address, int $customerBackId, int $frontId)
    {
        if (null === $address) {
            $address = new Address();
        }

        $address->setCustomerBackId($customerBackId);
        $address->setFrontId($frontId);

        $this->addressRepository->persistAndFlush($address);
    }

    /**
     * @param CustomerBack $customerBack
     * @param AddressFront $addressFront
     * @return AddressFront
     */
    protected function updateAddressFrontFromCustomerBack(
        CustomerBack $customerBack,
        AddressFront $addressFront
    ): AddressFront
    {
        $zoneId = 3490;
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
        $addressFront->setZoneId($zoneId);
        $addressFront->setCustomField($this->storeFront->getDefaultCustomField());
        $this->addressFrontRepository->persistAndFlush($addressFront);

        return $addressFront;
    }

    /**
     *
     */
    protected function clear(): void
    {
        $this->addressFrontRepository->removeAll();
        $this->addressFrontRepository->resetAutoIncrements();
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
}