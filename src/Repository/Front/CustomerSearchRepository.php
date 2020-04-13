<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerSearch;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerSearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerSearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerSearch[]    findAll()
 * @method CustomerSearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerSearch[]    findByIds(string $ids)
 * @method void    save(CustomerSearch $instance)
 * @method void    saveAndFlush(CustomerSearch $instance)
 * @method void    remove(CustomerSearch $instance)
 * @method void    removeAndFlush(CustomerSearch $instance)
 */
class CustomerSearchRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerSearch::class);
    }
}
