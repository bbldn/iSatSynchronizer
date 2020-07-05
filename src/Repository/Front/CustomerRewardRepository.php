<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerReward;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method CustomerReward|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerReward|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerReward[]    findAll()
 * @method CustomerReward[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerReward[]    findByIds(string $ids)
 * @method void    persist(CustomerReward $instance)
 * @method void    persistAndFlush(CustomerReward $instance)
 * @method void    remove(CustomerReward $instance)
 * @method void    removeAndFlush(CustomerReward $instance)
 */
class CustomerRewardRepository extends FrontRepository
{
    /**
     * CustomerRewardRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, CustomerReward::class);
    }
}
