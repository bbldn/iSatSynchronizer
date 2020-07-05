<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerActivity;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method CustomerActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerActivity[]    findAll()
 * @method CustomerActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerActivity[]    findByIds(string $ids)
 * @method void    persist(CustomerActivity $instance)
 * @method void    persistAndFlush(CustomerActivity $instance)
 * @method void    remove(CustomerActivity $instance)
 * @method void    removeAndFlush(CustomerActivity $instance)
 */
class CustomerActivityRepository extends FrontRepository
{
    /**
     * CustomerActivityRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, CustomerActivity::class);
    }
}
