<?php

namespace App\Service\Synchronizer\FrontToBack;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Exception\CustomerFrontNotFoundException;
use App\Exception\OrderFrontNotFoundException;
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

    /**
     * @param int $id
     * @return CustomerBack
     * @throws OrderFrontNotFoundException
     */
    public function synchronizeOneByOrderFrontId(int $id): CustomerBack
    {
        $orderFront = $this->orderFrontRepository->find($id);
        if (null === $orderFront) {
            $message = "Order Front with id: {$id} not found";
            throw new OrderFrontNotFoundException($message);
        }

        return $this->synchronizeOneByOrderFront($orderFront);
    }
}