<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductCategory;
use App\Helper\Repository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductCategory[]    findAll()
 * @method ProductCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductCategory[]    findByIds(string $ids)
 * @method void    persist(ProductCategory $instance)
 * @method void    persistAndFlush(ProductCategory $instance)
 * @method void    remove(ProductCategory $instance)
 * @method void    removeAndFlush(ProductCategory $instance)
 */
class ProductCategoryRepository extends FrontRepository
{
    /**
     * ProductCategoryRepository constructor.
     * @param ManagerRegistry $registry
     */
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
}
