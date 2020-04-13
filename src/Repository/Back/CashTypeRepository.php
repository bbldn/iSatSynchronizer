<?php

namespace App\Repository\Back;

use App\Entity\Back\CashType;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CashType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CashType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CashType[]    findAll()
 * @method CashType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CashTypeRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CashType::class);
    }

    // /**
    //  * @return CashType[] Returns an array of CashType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CashType
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
