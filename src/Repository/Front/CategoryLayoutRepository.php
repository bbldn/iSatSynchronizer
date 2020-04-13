<?php

namespace App\Repository\Front;

use App\Entity\Front\CategoryLayout;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryLayout|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryLayout|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryLayout[]    findAll()
 * @method CategoryLayout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CategoryLayout[]    findByIds(string $ids)
 * @method void    save(CategoryLayout $instance)
 * @method void    saveAndFlush(CategoryLayout $instance)
 * @method void    remove(CategoryLayout $instance)
 * @method void    removeAndFlush(CategoryLayout $instance)
 */
class CategoryLayoutRepository extends EntityRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryLayout::class);
    }

    // /**
    //  * @return CategoryLayout[] Returns an array of CategoryLayout objects
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
    public function findOneBySomeField($value): ?CategoryLayout
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
