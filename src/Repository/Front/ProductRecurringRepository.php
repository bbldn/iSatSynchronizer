<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductRecurring;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductRecurring|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductRecurring|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductRecurring[]    findAll()
 * @method ProductRecurring[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductRecurring[]    findByIds(string $ids)
 * @method void    save(ProductRecurring $instance)
 * @method void    saveAndFlush(ProductRecurring $instance)
 * @method void    remove(ProductRecurring $instance)
 * @method void    removeAndFlush(ProductRecurring $instance)
 */
class ProductRecurringRepository extends EntityRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductRecurring::class);
    }

    // /**
    //  * @return ProductRecurring[] Returns an array of ProductRecurring objects
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
    public function findOneBySomeField($value): ?ProductRecurring
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
