<?php

namespace App\Repository\Front;

use App\Entity\Front\AttributeGroup;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method AttributeGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributeGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributeGroup[]    findAll()
 * @method AttributeGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method AttributeGroup[]    findByIds(string $ids)
 * @method void    persist(AttributeGroup $instance)
 * @method void    persistAndFlush(AttributeGroup $instance)
 * @method void    remove(AttributeGroup $instance)
 * @method void    removeAndFlush(AttributeGroup $instance)
 */
class AttributeGroupRepository extends FrontRepository
{
    /**
     * AttributeGroupRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, AttributeGroup::class);
    }
}
