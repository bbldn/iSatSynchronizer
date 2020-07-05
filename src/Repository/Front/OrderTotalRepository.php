<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderTotal;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

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
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, OrderTotal::class);
    }
}
