<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerOnline;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method CustomerOnline|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerOnline|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerOnline[]    findAll()
 * @method CustomerOnline[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerOnline[]    findByIds(string $ids)
 * @method void    persist(CustomerOnline $instance)
 * @method void    persistAndFlush(CustomerOnline $instance)
 * @method void    remove(CustomerOnline $instance)
 * @method void    removeAndFlush(CustomerOnline $instance)
 */
class CustomerOnlineRepository extends FrontRepository
{
    /**
     * CustomerOnlineRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, CustomerOnline::class);
    }
}
