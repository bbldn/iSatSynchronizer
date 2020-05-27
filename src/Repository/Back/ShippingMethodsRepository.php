<?php

namespace App\Repository\Back;

use App\Entity\Back\ShippingMethods;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ShippingMethods|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShippingMethods|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShippingMethods[]    findAll()
 * @method ShippingMethods[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShippingMethodsRepository extends BackRepository
{
    /**
     * ShippingMethodsRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShippingMethods::class);
    }
}
