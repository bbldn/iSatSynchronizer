<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGroupsShowPrices;
use App\Repository\BaseRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuyersGroupsShowPrices|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGroupsShowPrices|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGroupsShowPrices[]    findAll()
 * @method BuyersGroupsShowPrices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuyersGroupsShowPricesRepository extends BaseRepository
{
    protected $entityManagerName = 'back';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuyersGroupsShowPrices::class);
    }

    // /**
    //  * @return BuyersGroupsShowPrices[] Returns an array of BuyersGroupsShowPrices objects
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
    public function findOneBySomeField($value): ?BuyersGroupsShowPrices
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