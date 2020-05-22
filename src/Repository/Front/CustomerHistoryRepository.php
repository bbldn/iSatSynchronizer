<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerHistory;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerHistory[]    findAll()
 * @method CustomerHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerHistory[]    findByIds(string $ids)
 * @method void    persist(CustomerHistory $instance)
 * @method void    persistAndFlush(CustomerHistory $instance)
 * @method void    remove(CustomerHistory $instance)
 * @method void    removeAndFlush(CustomerHistory $instance)
 */
class CustomerHistoryRepository extends FrontRepository
{
    /**
     * CustomerHistoryRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerHistory::class);
    }
}
