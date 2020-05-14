<?php

namespace App\Repository\Front;

use App\Entity\Front\AttributeGroupDescription;
use App\Other\Repository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AttributeGroupDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributeGroupDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributeGroupDescription[]    findAll()
 * @method AttributeGroupDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method AttributeGroupDescription[]    findByIds(string $ids)
 * @method void    persist(AttributeGroupDescription $instance)
 * @method void    persistAndFlush(AttributeGroupDescription $instance)
 * @method void    remove(AttributeGroupDescription $instance)
 * @method void    removeAndFlush(AttributeGroupDescription $instance)
 */
class AttributeGroupDescriptionRepository extends FrontRepository
{
    /**
     * AttributeGroupDescriptionRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeGroupDescription::class);
    }
}
