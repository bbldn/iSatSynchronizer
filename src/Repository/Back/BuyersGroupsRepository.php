<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGroups;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuyersGroups|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGroups|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGroups[]    findAll()
 * @method BuyersGroups[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method BuyersGroups[]    findByIds(string $ids)
 * @method void    persist(BuyersGroups $instance)
 * @method void    persistAndFlush(BuyersGroups $instance)
 * @method void    remove(BuyersGroups $instance)
 * @method void    removeAndFlush(BuyersGroups $instance)
 */
class BuyersGroupsRepository extends EntityBackRepository
{
    /**
     * BuyersGroupsRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuyersGroups::class);
    }
}
