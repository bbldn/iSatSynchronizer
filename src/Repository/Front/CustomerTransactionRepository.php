<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerTransaction;
use App\Helper\Repository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerTransaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerTransaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerTransaction[]    findAll()
 * @method CustomerTransaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerTransaction[]    findByIds(string $ids)
 * @method void    persist(CustomerTransaction $instance)
 * @method void    persistAndFlush(CustomerTransaction $instance)
 * @method void    remove(CustomerTransaction $instance)
 * @method void    removeAndFlush(CustomerTransaction $instance)
 */
class CustomerTransactionRepository extends FrontRepository
{
    /**
     * CustomerTransactionRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerTransaction::class);
    }
}
