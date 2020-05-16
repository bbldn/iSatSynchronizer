<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderTotal;
use App\Helper\Repository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderTotal|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderTotal|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderTotal[]    findAll()
 * @method OrderTotal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderTotal[]    findByIds(string $ids)
 * @method void    persist(OrderTotal $instance)
 * @method void    persistAndFlush(OrderTotal $instance)
 * @method void    remove(OrderTotal $instance)
 * @method void    removeAndFlush(OrderTotal $instance)
 */
class OrderTotalRepository extends FrontRepository
{
    /**
     * OrderTotalRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderTotal::class);
    }
}
