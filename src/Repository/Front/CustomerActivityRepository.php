<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerActivity;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerActivity[]    findAll()
 * @method CustomerActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerActivity[]    findByIds(string $ids)
 * @method void    save(CustomerActivity $instance)
 * @method void    saveAndFlush(CustomerActivity $instance)
 * @method void    remove(CustomerActivity $instance)
 * @method void    removeAndFlush(CustomerActivity $instance)
 */
class CustomerActivityRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerActivity::class);
    }
}
