<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGroupsShowPrices;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuyersGroupsShowPrices|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGroupsShowPrices|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGroupsShowPrices[]    findAll()
 * @method BuyersGroupsShowPrices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method BuyersGroupsShowPrices[]    findByIds(string $ids)
 * @method void    save(BuyersGroupsShowPrices $instance)
 * @method void    saveAndFlush(BuyersGroupsShowPrices $instance)
 * @method void    remove(BuyersGroupsShowPrices $instance)
 * @method void    removeAndFlush(BuyersGroupsShowPrices $instance)
 */
class BuyersGroupsShowPricesRepository extends EntityBackRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuyersGroupsShowPrices::class);
    }
}
