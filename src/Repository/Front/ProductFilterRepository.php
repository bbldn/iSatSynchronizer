<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductFilter;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductFilter|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductFilter|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductFilter[]    findAll()
 * @method ProductFilter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductFilterRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductFilter::class);
    }

    // /**
    //  * @return ProductFilter[] Returns an array of ProductFilter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductFilter
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
