<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerSimpleFields;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

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
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, CustomerSimpleFields::class);
    }
}
