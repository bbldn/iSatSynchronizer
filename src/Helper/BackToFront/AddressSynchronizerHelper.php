<?php

namespace App\Helper\BackToFront;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Repository\CustomerRepository;

class AddressSynchronizerHelper
{
    /** @var CustomerRepository $customerRepository */
    protected $customerRepository;

    /**
     * AddressSynchronizerHelper constructor.
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param CustomerBack $customerBack
     * @return int
     */
    public function getCustomerFrontIdByCustomerBack(CustomerBack $customerBack): int
    {
        $customer = $this->customerRepository->findOneByBackId($customerBack->getId());
        if ($customer !== null && null !== $customer->getBackId()) {
            return $customer->getBackId();
        }

        return 0;
    }
}