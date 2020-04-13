<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerAffiliate;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerAffiliate|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerAffiliate|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerAffiliate[]    findAll()
 * @method CustomerAffiliate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerAffiliate[]    findByIds(string $ids)
 * @method void    save(CustomerAffiliate $instance)
 * @method void    saveAndFlush(CustomerAffiliate $instance)
 * @method void    remove(CustomerAffiliate $instance)
 * @method void    removeAndFlush(CustomerAffiliate $instance)
 */
class CustomerAffiliateRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerAffiliate::class);
    }
}
