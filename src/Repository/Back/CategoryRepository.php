<?php

namespace App\Repository\Back;

use App\Entity\Back\Category;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category|null findOneLast()
 * @method Category|null findOneFirst()
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Category[]    findByIds(string $ids)
 * @method void    persist(Category $instance)
 * @method void    persistAndFlush(Category $instance)
 * @method void    remove(Category $instance)
 * @method void    removeAndFlush(Category $instance)
 */
class CategoryRepository extends BackRepository
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

    /**
     * @return Category[]
     */
    public function findSortedByParent(): array
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.parent', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $name
     * @return Category[]
     */
    public function findByName(string $name): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name LIKE :val')
            ->setParameter('val', "%$name%")
            ->getQuery()
            ->getResult();
    }
}
