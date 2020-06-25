<?php

namespace App\Repository\Front;

use App\Entity\Front\CategoryPath;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method CategoryPath|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryPath|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryPath[]    findAll()
 * @method CategoryPath[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CategoryPath[]    findByIds(string $ids)
 * @method void    persist(CategoryPath $instance)
 * @method void    persistAndFlush(CategoryPath $instance)
 * @method void    remove(CategoryPath $instance)
 * @method void    removeAndFlush(CategoryPath $instance)
 */
class CategoryPathRepository extends FrontRepository
{
    /**
     * CategoryPathRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryPath::class);
    }

    /**
     * @param int $categoryId
     * @param int $pathId
     * @return CategoryPath|null
     */
    public function findOneByCategoryFrontIdAndPathId(int $categoryId, int $pathId): ?CategoryPath
    {
        try {
            return $this->createQueryBuilder('cp')
                ->andWhere('cp.categoryId = :categoryId')
                ->andWhere('cp.pathId = :pathId')
                ->setParameter('categoryId', $categoryId)
                ->setParameter('pathId', $pathId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
