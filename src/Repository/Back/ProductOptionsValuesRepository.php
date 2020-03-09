<?php

namespace App\Repository\Back;

use App\Entity\Back\ProductOptionsValues;
use App\Repository\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductOptionsValues|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductOptionsValues|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductOptionsValues[]    findAll()
 * @method ProductOptionsValues[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductOptionsValuesRepository extends BaseRepository
{
    protected $entityManagerName = 'back';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductOptionsValues::class);
    }

    // /**
    //  * @return ProductOptionsValues[] Returns an array of ProductOptionsValues objects
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
    public function findOneBySomeField($value): ?ProductOptionsValues
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
