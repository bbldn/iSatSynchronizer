<?php

namespace App\Service\Synchronizer\FrontToBack;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Exception\CustomerFrontNotFoundException;
use App\Service\Synchronizer\FrontToBack\Implementation\CustomerSynchronizer as CustomerBackSynchronizer;

class CustomerSynchronizer extends CustomerBackSynchronizer
{
    /**
     * @param int $id
     * @param string $password
     * @return CustomerBack
     * @throws CustomerFrontNotFoundException
     */
    public function synchronizeOne(int $id, string $password): CustomerBack
    {
        $customersFront = $this->customerFrontRepository->find($id);
        if (null === $customersFront) {
            throw new CustomerFrontNotFoundException();
        }

        return $this->synchronizeCustomer($customersFront, $password);
    }
}