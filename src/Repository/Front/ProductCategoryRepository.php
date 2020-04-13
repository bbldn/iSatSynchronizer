<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductCategory;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductCategory[]    findAll()
 * @method ProductCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductCategory[]    findByIds(string $ids)
 * @method void    save(ProductCategory $instance)
 * @method void    saveAndFlush(ProductCategory $instance)
 * @method void    remove(ProductCategory $instance)
 * @method void    removeAndFlush(ProductCategory $instance)
 */
class ProductCategoryRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductCategory::class);
    }

    /**
     * @param int $value
     * @return ProductCategory[] Returns an array of Category objects
     */
    public function findByProductFrontId(int $value)
    {
        return $this->createQueryBuilder('cr')
            ->andWhere('cr.productId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return ProductCategory[] Returns an array of ProductCategory objects
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
    public function findOneBySomeField($value): ?ProductCategory
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
