<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerGroup;
use App\Other\Repository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerGroup[]    findAll()
 * @method CustomerGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerGroup[]    findByIds(string $ids)
 * @method void    persist(CustomerGroup $instance)
 * @method void    persistAndFlush(CustomerGroup $instance)
 * @method void    remove(CustomerGroup $instance)
 * @method void    removeAndFlush(CustomerGroup $instance)
 */
class CustomerGroupRepository extends FrontRepository
{
    /**
     * CustomerGroupRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerGroup::class);
    }
}
