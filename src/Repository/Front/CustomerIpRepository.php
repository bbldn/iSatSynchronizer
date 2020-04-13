<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerIp;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerIp|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerIp|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerIp[]    findAll()
 * @method CustomerIp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerIp[]    findByIds(string $ids)
 * @method void    save(CustomerIp $instance)
 * @method void    saveAndFlush(CustomerIp $instance)
 * @method void    remove(CustomerIp $instance)
 * @method void    removeAndFlush(CustomerIp $instance)
 */
class CustomerIpRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerIp::class);
    }
}
