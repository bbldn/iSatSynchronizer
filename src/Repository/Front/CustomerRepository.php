<?php

namespace App\Repository\Front;

use App\Entity\Front\Customer;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Customer[]    findByIds(string $ids)
 * @method void    save(Customer $instance)
 * @method void    saveAndFlush(Customer $instance)
 * @method void    remove(Customer $instance)
 * @method void    removeAndFlush(Customer $instance)
 */
class CustomerRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }
}
