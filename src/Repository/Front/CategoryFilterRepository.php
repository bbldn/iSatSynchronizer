<?php

namespace App\Repository\Front;

use App\Entity\Front\CategoryFilter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method CategoryFilter|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryFilter|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryFilter[]    findAll()
 * @method CategoryFilter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CategoryFilter[]    findByIds(string $ids)
 * @method void    persist(CategoryFilter $instance)
 * @method void    persistAndFlush(CategoryFilter $instance)
 * @method void    remove(CategoryFilter $instance)
 * @method void    removeAndFlush(CategoryFilter $instance)
 */
class CategoryFilterRepository extends FrontRepository
{
    /**
     * CategoryFilterRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, CategoryFilter::class);
    }
}
