<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGamePost;
use App\Repository\BaseRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuyersGamePost|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGamePost|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGamePost[]    findAll()
 * @method BuyersGamePost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuyersGamePostRepository extends BaseRepository
{
    protected $entityManagerName = 'back';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuyersGamePost::class);
    }

    // /**
    //  * @return BuyersGamePost[] Returns an array of BuyersGamePost objects
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
    public function findOneBySomeField($value): ?BuyersGamePost
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