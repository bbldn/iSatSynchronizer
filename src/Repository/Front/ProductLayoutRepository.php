<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductLayout;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

/**
 * @method ProductLayout|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductLayout|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductLayout[]    findAll()
 * @method ProductLayout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductLayout[]    findByIds(string $ids)
 * @method void    persist(ProductLayout $instance)
 * @method void    persistAndFlush(ProductLayout $instance)
 * @method void    remove(ProductLayout $instance)
 * @method void    removeAndFlush(ProductLayout $instance)
 */
class ProductLayoutRepository extends FrontRepository
{
    /**
     * ProductLayoutRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, ProductLayout::class);
    }

    /**
     * @param int $productId
     * @param int $storeId
     * @return ProductLayout|null
     */
    public function findOneByProductFrontIdAndStoreId(int $productId, int $storeId): ?ProductLayout
    {
        try {
            return $this->createQueryBuilder('pl')
                ->andWhere('pl.productId = :productId')
                ->setParameter('productId', $productId)
                ->andWhere('pl.storeId = :storeId')
                ->setParameter('storeId', $storeId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return null;
        }
    }
}
