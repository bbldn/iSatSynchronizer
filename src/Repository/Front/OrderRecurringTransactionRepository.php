<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderRecurringTransaction;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderRecurringTransaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderRecurringTransaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderRecurringTransaction[]    findAll()
 * @method OrderRecurringTransaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderRecurringTransaction[]    findByIds(string $ids)
 * @method void    save(OrderRecurringTransaction $instance)
 * @method void    saveAndFlush(OrderRecurringTransaction $instance)
 * @method void    remove(OrderRecurringTransaction $instance)
 * @method void    removeAndFlush(OrderRecurringTransaction $instance)
 */
class OrderRecurringTransactionRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderRecurringTransaction::class);
    }
}
