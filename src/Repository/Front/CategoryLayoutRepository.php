<?php

namespace App\Repository\Front;

use App\Entity\Front\CategoryLayout;
use App\Helper\Repository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryLayout|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryLayout|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryLayout[]    findAll()
 * @method CategoryLayout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CategoryLayout[]    findByIds(string $ids)
 * @method void    persist(CategoryLayout $instance)
 * @method void    persistAndFlush(CategoryLayout $instance)
 * @method void    remove(CategoryLayout $instance)
 * @method void    removeAndFlush(CategoryLayout $instance)
 */
class CategoryLayoutRepository extends FrontRepository
{
    /**
     * CategoryLayoutRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryLayout::class);
    }
}
