<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Address;
use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Entity\Front\Address as AddressFront;
use App\Helper\Filler;
use App\Helper\Front\Store as StoreFront;
use App\Repository\AddressRepository;
use App\Repository\Back\BuyersGamePostRepository as CustomerBackRepository;
use App\Repository\CustomerRepository;
use App\Repository\Front\AddressRepository as AddressFrontRepository;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;

class AddressSynchronizer extends BackToFrontSynchronizer
{
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
     * @param CustomerBackRepository $customerBackRepository
     * @param CustomerRepository $customerRepository
     * @param AddressFrontRepository $addressFrontRepository
     * @param AddressRepository $addressRepository
     * @param StoreFront $storeFront
     */
    public function __construct(
        CustomerBackRepository $customerBackRepository,
        CustomerRepository $customerRepository,
        AddressFrontRepository $addressFrontRepository,
        AddressRepository $addressRepository,
        StoreFront $storeFront
    )
    {
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
    protected function getAddressFrontFromAddress(?Address $address): ?AddressFront
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
    protected function createOrUpdateAddress(?Address $address, int $customerBackId, int $frontId): void
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
        if (null === $addressFront->getCustomerId()) {
            $customerFrontId = $this->getCustomerFrontIdByCustomerBack($customerBack);
            $addressFront->setCustomerId($customerFrontId);
        }

        $fullName = $this->parseFirstLastName($customerBack->getFio());

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
        $parsedFio = explode(' ', $fio);

        if (0 === count($parsedFio)) {
            $data = [
                'firstName' => ' ',
                'lastName' => ' ',
            ];
        } elseif (1 === count($parsedFio)) {
            $data = [
                'firstName' => ' ',
                'lastName' => trim($parsedFio[0]),
            ];
        } else {
            $data = [
                'firstName' => trim($parsedFio[1]),
                'lastName' => trim($parsedFio[0]),
            ];
        }

        return $data;
    }

    /**
     * @param CustomerBack $customerBack
     * @return int
     */
    protected function getCustomerFrontIdByCustomerBack(CustomerBack $customerBack): int
    {
        $customer = $this->customerRepository->findOneByBackId($customerBack->getId());
        if ($customer !== null && null !== $customer->getBackId()) {
            return $customer->getBackId();
        }

        return 0;
    }
}