<?php

namespace App\Repository\Back;

use App\Entity\Back\OrderStatusChangeLog;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderStatusChangeLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderStatusChangeLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderStatusChangeLog[]    findAll()
 * @method OrderStatusChangeLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderStatusChangeLog[]    findByIds(string $ids)
 * @method void    persist(OrderStatusChangeLog $instance)
 * @method void    persistAndFlush(OrderStatusChangeLog $instance)
 * @method void    remove(OrderStatusChangeLog $instance)
 * @method void    removeAndFlush(OrderStatusChangeLog $instance)
 */
class OrderStatusChangeLogRepository extends EntityBackRepository
{
    /**
     * OrderStatusChangeLogRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderStatusChangeLog::class);
    }
}
