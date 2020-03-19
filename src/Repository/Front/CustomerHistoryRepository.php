<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerHistory[]    findAll()
 * @method CustomerHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerHistory::class);
    }

    // /**
    //  * @return CustomerHistory[] Returns an array of CustomerHistory objects
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
    public function findOneBySomeField($value): ?CustomerHistory
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
