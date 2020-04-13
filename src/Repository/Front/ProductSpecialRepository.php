<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductSpecial;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductSpecial|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductSpecial|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductSpecial[]    findAll()
 * @method ProductSpecial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductSpecial[]    findByIds(string $ids)
 * @method void    save(ProductSpecial $instance)
 * @method void    saveAndFlush(ProductSpecial $instance)
 * @method void    remove(ProductSpecial $instance)
 * @method void    removeAndFlush(ProductSpecial $instance)
 */
class ProductSpecialRepository extends EntityRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductSpecial::class);
    }

    // /**
    //  * @return ProductSpecial[] Returns an array of ProductSpecial objects
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
    public function findOneBySomeField($value): ?ProductSpecial
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
