<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGroupsExtra;
use App\Repository\BaseRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuyersGroupsExtra|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGroupsExtra|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGroupsExtra[]    findAll()
 * @method BuyersGroupsExtra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuyersGroupsExtraRepository extends BaseRepository
{
    protected $entityManagerName = 'back';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuyersGroupsExtra::class);
    }

    // /**
    //  * @return BuyersGroupsExtra[] Returns an array of BuyersGroupsExtra objects
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
    public function findOneBySomeField($value): ?BuyersGroupsExtra
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
