<?php

namespace App\Repository\Front;

use App\Entity\Front\CategoryFilter;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryFilter|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryFilter|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryFilter[]    findAll()
 * @method CategoryFilter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CategoryFilter[]    findByIds(string $ids)
 * @method void    save(CategoryFilter $instance)
 * @method void    saveAndFlush(CategoryFilter $instance)
 * @method void    remove(CategoryFilter $instance)
 * @method void    removeAndFlush(CategoryFilter $instance)
 */
class CategoryFilterRepository extends EntityRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryFilter::class);
    }

    // /**
    //  * @return CategoryFilter[] Returns an array of CategoryFilter objects
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
    public function findOneBySomeField($value): ?CategoryFilter
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
