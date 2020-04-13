<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderVoucher;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderVoucher|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderVoucher|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderVoucher[]    findAll()
 * @method OrderVoucher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderVoucherRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderVoucher::class);
    }

    // /**
    //  * @return OrderVoucher[] Returns an array of OrderVoucher objects
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
    public function findOneBySomeField($value): ?OrderVoucher
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
