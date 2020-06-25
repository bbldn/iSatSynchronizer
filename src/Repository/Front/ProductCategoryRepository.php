<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductCategory;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

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
     * @param int $productId
     * @param int $categoryId
     * @return ProductCategory|null
     */
    public function findOneByProductFrontIdAndCategoryId(int $productId, int $categoryId): ?ProductCategory
    {
        try {
            return $this->createQueryBuilder('pc')
                ->andWhere('pc.productId = :productId')
                ->setParameter('productId', $productId)
                ->andWhere('pc.categoryId = :categoryId')
                ->setParameter('categoryId', $categoryId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param int $value
     * @return ProductCategory[]
     */
    public function findByProductFrontId(int $value): array
    {
        return $this->createQueryBuilder('pc')
            ->andWhere('pc.productId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }
}
