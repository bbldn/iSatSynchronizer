<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductRelated;
use App\Repository\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductRelated|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductRelated|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductRelated[]    findAll()
 * @method ProductRelated[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRelatedRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductRelated::class);
    }

    // /**
    //  * @return ProductRelated[] Returns an array of ProductRelated objects
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
    public function findOneBySomeField($value): ?ProductRelated
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
