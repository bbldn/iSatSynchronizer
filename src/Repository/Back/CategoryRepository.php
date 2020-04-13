<?php

namespace App\Repository\Back;

use App\Entity\Back\Category;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Category[]    findByIds(string $ids)
 * @method void    save(Category $instance)
 * @method void    saveAndFlush(Category $instance)
 * @method void    remove(Category $instance)
 * @method void    removeAndFlush(Category $instance)
 */
class CategoryRepository extends EntityBackRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @return Category[] Returns an array of Category objects
     */
    public function findAllSortByParent()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.parent', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
