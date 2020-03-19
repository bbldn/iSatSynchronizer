<?php

namespace App\Repository\Back;

use App\Entity\Back\OrderPriceDiscount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderPriceDiscount|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderPriceDiscount|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderPriceDiscount[]    findAll()
 * @method OrderPriceDiscount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderPriceDiscountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderPriceDiscount::class);
    }

    // /**
    //  * @return OrderPriceDiscount[] Returns an array of OrderPriceDiscount objects
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
    public function findOneBySomeField($value): ?OrderPriceDiscount
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
