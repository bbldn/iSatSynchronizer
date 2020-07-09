<?php

namespace App\Contract\FrontToBack;

use App\Entity\Back\BuyersGamePost as CustomerBack;
use App\Contract\CanLoadInterface;

interface CustomerSynchronizerContract extends CanLoadInterface
{
    /**
     * @param int $id
     * @param string $password
     * @return CustomerBack
     */
    public function synchronizeOne(int $id, string $password): CustomerBack;

    /**
     * @param int $id
     * @return CustomerBack
     */
    public function synchronizeOneByOrderFrontId(int $id): CustomerBack;
}