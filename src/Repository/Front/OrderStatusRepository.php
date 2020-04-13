<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderStatus;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderStatus[]    findAll()
 * @method OrderStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderStatus[]    findByIds(string $ids)
 * @method void    save(OrderStatus $instance)
 * @method void    saveAndFlush(OrderStatus $instance)
 * @method void    remove(OrderStatus $instance)
 * @method void    removeAndFlush(OrderStatus $instance)
 */
class OrderStatusRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderStatus::class);
    }
}
