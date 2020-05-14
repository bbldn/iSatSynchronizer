<?php

namespace App\Repository\Front;

use App\Entity\Front\CategoryDescription;
use App\Other\Repository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryDescription[]    findAll()
 * @method CategoryDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CategoryDescription[]    findByIds(string $ids)
 * @method void    persist(CategoryDescription $instance)
 * @method void    persistAndFlush(CategoryDescription $instance)
 * @method void    remove(CategoryDescription $instance)
 * @method void    removeAndFlush(CategoryDescription $instance)
 */
class CategoryDescriptionRepository extends FrontRepository
{
    /**
     * CategoryDescriptionRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryDescription::class);
    }
}
