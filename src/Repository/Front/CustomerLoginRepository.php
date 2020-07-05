<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerLogin;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method CustomerLogin|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerLogin|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerLogin[]    findAll()
 * @method CustomerLogin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerLogin[]    findByIds(string $ids)
 * @method void    persist(CustomerLogin $instance)
 * @method void    persistAndFlush(CustomerLogin $instance)
 * @method void    remove(CustomerLogin $instance)
 * @method void    removeAndFlush(CustomerLogin $instance)
 */
class CustomerLoginRepository extends FrontRepository
{
    /**
     * CustomerLoginRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, CustomerLogin::class);
    }
}
