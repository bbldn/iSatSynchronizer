<?php

namespace App\Repository\Back;

use App\Entity\Back\ShippingMethod;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

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
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, ShippingMethod::class);
    }
}
