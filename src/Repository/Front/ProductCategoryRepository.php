<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductCategory;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

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
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, ProductCategory::class);
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
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

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
