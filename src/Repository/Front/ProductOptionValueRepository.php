<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductOptionValue;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductOptionValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductOptionValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductOptionValue[]    findAll()
 * @method ProductOptionValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductOptionValue[]    findByIds(string $ids)
 * @method void    save(ProductOptionValue $instance)
 * @method void    saveAndFlush(ProductOptionValue $instance)
 * @method void    remove(ProductOptionValue $instance)
 * @method void    removeAndFlush(ProductOptionValue $instance)
 */
class ProductOptionValueRepository extends EntityRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductOptionValue::class);
    }

    // /**
    //  * @return ProductOptionValue[] Returns an array of ProductOptionValue objects
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
    public function findOneBySomeField($value): ?ProductOptionValue
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
