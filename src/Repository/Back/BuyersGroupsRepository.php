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
 * @method void    save(BuyersGroups $instance)
 * @method void    saveAndFlush(BuyersGroups $instance)
 * @method void    remove(BuyersGroups $instance)
 * @method void    removeAndFlush(BuyersGroups $instance)
 */
class BuyersGroupsRepository extends EntityBackRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuyersGroups::class);
    }
}
