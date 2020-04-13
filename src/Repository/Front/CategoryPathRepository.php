<?php

namespace App\Repository\Front;

use App\Entity\Front\CategoryPath;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryPath|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryPath|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryPath[]    findAll()
 * @method CategoryPath[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CategoryPath[]    findByIds(string $ids)
 * @method void    save(CategoryPath $instance)
 * @method void    saveAndFlush(CategoryPath $instance)
 * @method void    remove(CategoryPath $instance)
 * @method void    removeAndFlush(CategoryPath $instance)
 */
class CategoryPathRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryPath::class);
    }

    public function findByCategoryFrontIdAndPathId(int $categoryId, int $pathId)
    {
        return $this->createQueryBuilder('cp')
            ->andWhere('cp.categoryId = :categoryId')
            ->andWhere('cp.pathId = :pathId')
            ->setParameter('categoryId', $categoryId)
            ->setParameter('pathId', $pathId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
