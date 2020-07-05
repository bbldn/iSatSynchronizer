<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Category[]    findByIds(string $ids)
 * @method void    persist(Category $instance)
 * @method void    persistAndFlush(Category $instance)
 * @method void    remove(Category $instance)
 * @method void    removeAndFlush(Category $instance)
 * @method Category|null    findOneByBackId(int $value)
 * @method Category|null    findOneByFrontId(int $value)
 */
class CategoryRepository extends EntityRepository
{
    /**
     * CategoryRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Category::class);
    }
}
