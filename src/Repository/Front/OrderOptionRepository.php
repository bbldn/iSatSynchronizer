<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderOption;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderOption[]    findAll()
 * @method OrderOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderOption[]    findByIds(string $ids)
 * @method void    persist(OrderOption $instance)
 * @method void    persistAndFlush(OrderOption $instance)
 * @method void    remove(OrderOption $instance)
 * @method void    removeAndFlush(OrderOption $instance)
 */
class OrderOptionRepository extends EntityFrontRepository
{
    /**
     * OrderOptionRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderOption::class);
    }
}
