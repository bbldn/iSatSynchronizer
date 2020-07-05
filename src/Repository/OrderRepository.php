<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Common\Persistence\ManagerRegistry;
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
 * @method Order|null    findOneByBackId(int $value)
 * @method Order|null    findOneByFrontId(int $value)
 */
class OrderRepository extends EntityRepository
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
}
