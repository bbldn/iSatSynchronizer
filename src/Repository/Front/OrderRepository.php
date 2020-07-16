<?php

namespace App\Repository\Front;

use App\Entity\Front\Order;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Order[]    findByIds(string $ids)
 * @method void    persist(Order $instance)
 * @method void    persistAndFlush(Order $instance)
 * @method void    remove(Order $instance)
 * @method void    removeAndFlush(Order $instance)
 */
class OrderRepository extends FrontRepository
{
    /**
     * OrderRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Order::class);
    }

    /**
     * @param int $customerId
     * @return Order|null
     */
    public function findOneLastByCustomerId(int $customerId): ?Order
    {
        try {
            return $this->createQueryBuilder('o')
                ->andWhere('o.customerId = :customerId')
                ->setParameter('customerId', $customerId)
                ->orderBy('o.orderId', 'ASC')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return null;
        }
    }
}
