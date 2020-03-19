<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGroups;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuyersGroups|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGroups|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGroups[]    findAll()
 * @method BuyersGroups[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuyersGroupsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuyersGroups::class);
    }

    // /**
    //  * @return BuyersGroups[] Returns an array of BuyersGroups objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BuyersGroups
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
