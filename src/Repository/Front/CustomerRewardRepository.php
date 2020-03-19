<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerReward;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerReward|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerReward|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerReward[]    findAll()
 * @method CustomerReward[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRewardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerReward::class);
    }

    // /**
    //  * @return CustomerReward[] Returns an array of CustomerReward objects
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
    public function findOneBySomeField($value): ?CustomerReward
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
