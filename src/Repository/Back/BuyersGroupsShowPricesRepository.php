<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGroupsShowPrices;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method BuyersGroupsShowPrices|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGroupsShowPrices|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGroupsShowPrices[]    findAll()
 * @method BuyersGroupsShowPrices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method BuyersGroupsShowPrices[]    findByIds(string $ids)
 * @method void    persist(BuyersGroupsShowPrices $instance)
 * @method void    persistAndFlush(BuyersGroupsShowPrices $instance)
 * @method void    remove(BuyersGroupsShowPrices $instance)
 * @method void    removeAndFlush(BuyersGroupsShowPrices $instance)
 */
class BuyersGroupsShowPricesRepository extends BackRepository
{
    /**
     * BuyersGroupsShowPricesRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, BuyersGroupsShowPrices::class);
    }
}
