<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGroupsExtra;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method BuyersGroupsExtra|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGroupsExtra|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGroupsExtra[]    findAll()
 * @method BuyersGroupsExtra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method BuyersGroupsExtra[]    findByIds(string $ids)
 * @method void    persist(BuyersGroupsExtra $instance)
 * @method void    persistAndFlush(BuyersGroupsExtra $instance)
 * @method void    remove(BuyersGroupsExtra $instance)
 * @method void    removeAndFlush(BuyersGroupsExtra $instance)
 */
class BuyersGroupsExtraRepository extends BackRepository
{
    /**
     * BuyersGroupsExtraRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, BuyersGroupsExtra::class);
    }
}
