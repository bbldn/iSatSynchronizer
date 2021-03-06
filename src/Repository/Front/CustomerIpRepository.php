<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerIp;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method CustomerIp|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerIp|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerIp[]    findAll()
 * @method CustomerIp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerIp[]    findByIds(string $ids)
 * @method void    persist(CustomerIp $instance)
 * @method void    persistAndFlush(CustomerIp $instance)
 * @method void    remove(CustomerIp $instance)
 * @method void    removeAndFlush(CustomerIp $instance)
 */
class CustomerIpRepository extends FrontRepository
{
    /**
     * CustomerIpRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, CustomerIp::class);
    }
}
