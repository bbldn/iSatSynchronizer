<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderRecurring;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method OrderRecurring|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderRecurring|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderRecurring[]    findAll()
 * @method OrderRecurring[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderRecurring[]    findByIds(string $ids)
 * @method void    persist(OrderRecurring $instance)
 * @method void    persistAndFlush(OrderRecurring $instance)
 * @method void    remove(OrderRecurring $instance)
 * @method void    removeAndFlush(OrderRecurring $instance)
 */
class OrderRecurringRepository extends FrontRepository
{
    /**
     * OrderRecurringRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, OrderRecurring::class);
    }
}
