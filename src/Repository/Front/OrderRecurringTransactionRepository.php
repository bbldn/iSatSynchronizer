<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderRecurringTransaction;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method OrderRecurringTransaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderRecurringTransaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderRecurringTransaction[]    findAll()
 * @method OrderRecurringTransaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderRecurringTransaction[]    findByIds(string $ids)
 * @method void    persist(OrderRecurringTransaction $instance)
 * @method void    persistAndFlush(OrderRecurringTransaction $instance)
 * @method void    remove(OrderRecurringTransaction $instance)
 * @method void    removeAndFlush(OrderRecurringTransaction $instance)
 */
class OrderRecurringTransactionRepository extends FrontRepository
{
    /**
     * OrderRecurringTransactionRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, OrderRecurringTransaction::class);
    }
}
