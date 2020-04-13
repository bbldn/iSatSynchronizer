<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerWishList;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerWishList|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerWishList|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerWishList[]    findAll()
 * @method CustomerWishList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerWishListRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerWishList::class);
    }

    // /**
    //  * @return CustomerWishList[] Returns an array of CustomerWishList objects
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
    public function findOneBySomeField($value): ?CustomerWishList
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
