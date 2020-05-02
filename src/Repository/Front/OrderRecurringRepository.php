<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderRecurring;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

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
class OrderRecurringRepository extends EntityFrontRepository
{
    /**
     * OrderRecurringRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderRecurring::class);
    }
}
