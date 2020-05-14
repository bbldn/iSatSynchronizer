<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerSimpleFields;
use App\Other\Repository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerSimpleFields|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerSimpleFields|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerSimpleFields[]    findAll()
 * @method CustomerSimpleFields[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerSimpleFields[]    findByIds(string $ids)
 * @method void    persist(CustomerSimpleFields $instance)
 * @method void    persistAndFlush(CustomerSimpleFields $instance)
 * @method void    remove(CustomerSimpleFields $instance)
 * @method void    removeAndFlush(CustomerSimpleFields $instance)
 */
class CustomerSimpleFieldsRepository extends FrontRepository
{
    /**
     * CustomerSimpleFieldsRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerSimpleFields::class);
    }
}
