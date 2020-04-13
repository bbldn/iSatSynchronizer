<?php

namespace App\Repository\Front;

use App\Entity\Front\CategoryStore;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryStore|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryStore|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryStore[]    findAll()
 * @method CategoryStore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CategoryStore[]    findByIds(string $ids)
 * @method void    save(CategoryStore $instance)
 * @method void    saveAndFlush(CategoryStore $instance)
 * @method void    remove(CategoryStore $instance)
 * @method void    removeAndFlush(CategoryStore $instance)
 */
class CategoryStoreRepository extends EntityRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryStore::class);
    }

    // /**
    //  * @return CategoryStore[] Returns an array of CategoryStore objects
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
    public function findOneBySomeField($value): ?CategoryStore
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
