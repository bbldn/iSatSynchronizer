<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductStore;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method ProductStore|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductStore|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductStore[]    findAll()
 * @method ProductStore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductStore[]    findByIds(string $ids)
 * @method void    persist(ProductStore $instance)
 * @method void    persistAndFlush(ProductStore $instance)
 * @method void    remove(ProductStore $instance)
 * @method void    removeAndFlush(ProductStore $instance)
 */
class ProductStoreRepository extends FrontRepository
{
    /**
     * ProductStoreRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductStore::class);
    }

    /**
     * @param int $productId
     * @param int $storeId
     * @return ProductStore|null
     */
    public function findOneByProductFrontIdAndStoreId(int $productId, int $storeId): ?ProductStore
    {
        try {
            return $this->createQueryBuilder('ps')
                ->andWhere('ps.productId = :productId')
                ->setParameter('productId', $productId)
                ->andWhere('ps.storeId = :storeId')
                ->setParameter('storeId', $storeId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
