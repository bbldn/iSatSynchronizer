<?php

namespace App\Repository\Back;

use App\Entity\Back\OrderGamePost;
use App\Repository\BaseRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderGamePost|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderGamePost|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderGamePost[]    findAll()
 * @method OrderGamePost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderGamePostRepository extends BaseRepository
{
    protected $entityManagerName = 'back';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderGamePost::class);
    }

    // /**
    //  * @return OrderGamePost[] Returns an array of OrderGamePost objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderGamePost
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
