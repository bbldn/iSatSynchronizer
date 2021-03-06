<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderStatus;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method OrderStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderStatus[]    findAll()
 * @method OrderStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderStatus[]    findByIds(string $ids)
 * @method void    persist(OrderStatus $instance)
 * @method void    persistAndFlush(OrderStatus $instance)
 * @method void    remove(OrderStatus $instance)
 * @method void    removeAndFlush(OrderStatus $instance)
 */
class OrderStatusRepository extends FrontRepository
{
    /**
     * OrderStatusRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, OrderStatus::class);
    }
}
