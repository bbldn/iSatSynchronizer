<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderSimpleFields;
use App\Other\Repository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderSimpleFields|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderSimpleFields|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderSimpleFields[]    findAll()
 * @method OrderSimpleFields[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderSimpleFields[]    findByIds(string $ids)
 * @method void    persist(OrderSimpleFields $instance)
 * @method void    persistAndFlush(OrderSimpleFields $instance)
 * @method void    remove(OrderSimpleFields $instance)
 * @method void    removeAndFlush(OrderSimpleFields $instance)
 */
class OrderSimpleFieldsRepository extends FrontRepository
{
    /**
     * OrderSimpleFieldsRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderSimpleFields::class);
    }
}
