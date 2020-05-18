<?php

namespace App\Service\Synchronizer\FrontToBack;

use App\Exception\CustomerFrontNotFoundException;
use App\Service\Synchronizer\FrontToBack\Implementation\CustomerSynchronizer as CustomerBackSynchronizer;

class CustomerSynchronizer extends CustomerBackSynchronizer
{
    /**
     * @param int $id
     * @param string $password
     * @throws CustomerFrontNotFoundException
     */
    public function synchronizeOne(int $id, string $password): void
    {
        $customersFront = $this->customerFrontRepository->find($id);
        if (null === $customersFront) {
            throw new CustomerFrontNotFoundException();
        }

        $this->synchronizeCustomer($customersFront, $password);
    }
}