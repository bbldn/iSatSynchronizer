<?php

namespace App\Repository\Back;

use App\Entity\Back\ShippingMethod;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ShippingMethod|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShippingMethod|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShippingMethod[]    findAll()
 * @method ShippingMethod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShippingMethodRepository extends BackRepository
{
    /**
     * ShippingMethodsRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShippingMethod::class);
    }
}
