<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerGroupDescription;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method CustomerGroupDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerGroupDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerGroupDescription[]    findAll()
 * @method CustomerGroupDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerGroupDescription[]    findByIds(string $ids)
 * @method void    persist(CustomerGroupDescription $instance)
 * @method void    persistAndFlush(CustomerGroupDescription $instance)
 * @method void    remove(CustomerGroupDescription $instance)
 * @method void    removeAndFlush(CustomerGroupDescription $instance)
 */
class CustomerGroupDescriptionRepository extends FrontRepository
{
    /**
     * CustomerGroupDescriptionRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, CustomerGroupDescription::class);
    }
}
