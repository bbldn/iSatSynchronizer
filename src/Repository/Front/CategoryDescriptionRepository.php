<?php

namespace App\Repository\Front;

use App\Entity\Front\CategoryDescription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryDescription[]    findAll()
 * @method CategoryDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryDescriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryDescription::class);
    }

    // /**
    //  * @return CategoryDescription[] Returns an array of CategoryDescription objects
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
    public function findOneBySomeField($value): ?CategoryDescription
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
