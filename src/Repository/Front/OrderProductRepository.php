<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderProduct;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

/**
 * @method OrderProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderProduct[]    findAll()
 * @method OrderProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderProduct[]    findByIds(string $ids)
 * @method void    persist(OrderProduct $instance)
 * @method void    persistAndFlush(OrderProduct $instance)
 * @method void    remove(OrderProduct $instance)
 * @method void    removeAndFlush(OrderProduct $instance)
 */
class OrderProductRepository extends FrontRepository
{
    /**
     * OrderProductRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, OrderProduct::class);
    }

    /**
     * @param int $value
     * @return OrderProduct[]
     */
    public function findByOrderFrontId(int $value): array
    {
        return $this->createQueryBuilder('op')
            ->andWhere('op.orderId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $orderFrontId
     * @param int $productFrontId
     * @return OrderProduct|null
     */
    public function findOneByOrderFrontIdAndProductFrontId(int $orderFrontId, int $productFrontId): ?OrderProduct
    {
        try {
            return $this->createQueryBuilder('op')
                ->andWhere('op.orderId = :orderFrontId')
                ->setParameter('orderFrontId', $orderFrontId)
                ->andWhere('op.productId = :productFrontId')
                ->setParameter('productFrontId', $productFrontId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }

    /**
     * @param int $orderId
     * @return mixed
     */
    public function removeAllByOrderFrontId(int $orderId)
    {
        return $this->createQueryBuilder('op')
            ->andWhere('op.orderId = :val')
            ->setParameter('val', $orderId)
            ->delete()
            ->getQuery()
            ->execute();
    }
}
