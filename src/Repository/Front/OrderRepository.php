<?php

namespace App\Repository\Front;

use App\Entity\Front\Order;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

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
class OrderRepository extends EntityFrontRepository
{
    /**
     * OrderRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }
}
