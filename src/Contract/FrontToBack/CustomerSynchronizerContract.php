<?php

namespace App\Contract\FrontToBack;

use App\Entity\Back\BuyersGamePost as CustomerBack;

interface CustomerSynchronizerContract
{
    /**
     *
     */
    public function load(): void;

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