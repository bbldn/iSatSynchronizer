<?php

namespace App\Helper\BackToFront;

use App\Contract\BackToFront\OrderSynchronizerHelperInterface;
use App\Entity\Back\OrderGamePost as OrderBack;
use App\Repository\Front\CustomerRepository as CustomerFrontRepository;
use App\Repository\CustomerRepository;
use App\Service\Synchronizer\BackToFront\CustomerSynchronizer as CustomerBackToFrontSynchronizer;

class OrderSynchronizerHelper implements OrderSynchronizerHelperInterface
{
    /** @var CustomerRepository $customerRepository */
    protected $customerRepository;

    /** @var CustomerFrontRepository $customerFrontRepository */
    protected $customerFrontRepository;

    /** @var CustomerBackToFrontSynchronizer $customerFrontRepository */
    protected $customerBackToFrontSynchronizer;

    /**
     * OrderSynchronizerHelper constructor.
     * @param CustomerRepository $customerRepository
     * @param CustomerFrontRepository $customerFrontRepository
     * @param CustomerBackToFrontSynchronizer $customerBackToFrontSynchronizer
     */
    public function __construct(
        CustomerRepository $customerRepository,
        CustomerFrontRepository $customerFrontRepository,
        CustomerBackToFrontSynchronizer $customerBackToFrontSynchronizer
    )
    {
        $this->customerRepository = $customerRepository;
        $this->customerFrontRepository = $customerFrontRepository;
        $this->customerBackToFrontSynchronizer = $customerBackToFrontSynchronizer;
    }

    /**
     * @param OrderBack $mainOrderBack
     * @return int|null
     */
    public function getCustomerFrontByCustomerBackId(OrderBack $mainOrderBack): ?int
    {
        $clientId = $mainOrderBack->getClientId();
        $customer = $this->customerRepository->findOneByBackId($clientId);

        if (null !== $customer) {
            $customerFront = $this->customerFrontRepository->find($customer->getFrontId());
            if (null !== $customerFront && null !== $customerFront->getCustomerId()) {
                return $customerFront->getCustomerId();
            }
        }

        $customerFront = $this->customerBackToFrontSynchronizer->synchronizeOneAndReturnCustomerFront($clientId);

        if (null !== $customerFront && null !== $customerFront->getCustomerId()) {
            return $customerFront->getCustomerId();
        }

        return 0;
    }
}