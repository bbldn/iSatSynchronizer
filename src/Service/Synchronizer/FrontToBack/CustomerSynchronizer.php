<?php

namespace App\Service\Synchronizer\FrontToBack;

use App\Service\Synchronizer\FrontToBack\Implementation\CustomerSynchronizer as CustomerBackSynchronizer;

class CustomerSynchronizer extends CustomerBackSynchronizer
{
    /**
     * @param string $ids
     */
    public function synchronizeByIds(string $ids): void
    {
        $customersFront = $this->customerFrontRepository->findByIds($ids);
        foreach ($customersFront as $customerFront) {
            $this->synchronizeCustomer($customerFront);
        }
    }

    /**
     *
     */
    public function synchronizeAll(): void
    {
        $customersFront = $this->customerFrontRepository->findAll();
        foreach ($customersFront as $customerFront) {
            $this->synchronizeCustomer($customerFront);
        }
    }
}