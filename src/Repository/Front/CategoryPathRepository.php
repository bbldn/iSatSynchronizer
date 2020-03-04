<?php

namespace App\Repository\Front;

use App\Entity\Front\CategoryPath;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryPath|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryPath|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryPath[]    findAll()
 * @method CategoryPath[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryPathRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryPath::class);
    }

    // /**
    //  * @return CategoryPath[] Returns an array of CategoryPath objects
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
    public function findOneBySomeField($value): ?CategoryPath
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
