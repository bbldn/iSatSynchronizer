<?php

namespace App\Repository\Back;

use App\Entity\Back\PaymentType;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PaymentType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaymentType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaymentType[]    findAll()
 * @method PaymentType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentTypeRepository extends BackRepository
{
    /**
     * PaymentTypeRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentType::class);
    }
}
