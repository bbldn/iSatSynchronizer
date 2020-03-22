<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderTotal;
use App\Repository\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderTotal|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderTotal|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderTotal[]    findAll()
 * @method OrderTotal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderTotalRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderTotal::class);
    }

    // /**
    //  * @return OrderTotal[] Returns an array of OrderTotal objects
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
    public function findOneBySomeField($value): ?OrderTotal
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