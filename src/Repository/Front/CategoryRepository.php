<?php

namespace App\Repository\Front;

use App\Entity\Front\Category;
use App\Other\EntityRepository;
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
class CategoryRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
        $this->_em = $registry->getManager('front');
    }

    public function checkExistsByCategoryId(?int $id)
    {
        if (null === $id) {
            return false;
        }

        return $this->createQueryBuilder('c')
                ->select('count(c.category)')
                ->andWhere('c.categoryId = :val')
                ->setParameter('val', $id)
                ->getQuery()
                ->getScalarResult() > 0;
    }
}
