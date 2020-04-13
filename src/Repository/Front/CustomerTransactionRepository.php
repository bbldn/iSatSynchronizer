<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerTransaction;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerTransaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerTransaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerTransaction[]    findAll()
 * @method CustomerTransaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerTransaction[]    findByIds(string $ids)
 * @method void    save(CustomerTransaction $instance)
 * @method void    saveAndFlush(CustomerTransaction $instance)
 * @method void    remove(CustomerTransaction $instance)
 * @method void    removeAndFlush(CustomerTransaction $instance)
 */
class CustomerTransactionRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerTransaction::class);
    }
}
