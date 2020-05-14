<?php

namespace App\Repository\Back;

use App\Entity\Back\Product;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Product[]    findByIds(string $ids)
 * @method void    persist(Product $instance)
 * @method void    persistAndFlush(Product $instance)
 * @method void    remove(Product $instance)
 * @method void    removeAndFlush(Product $instance)
 */
class ProductRepository extends BackRepository
{
    /**
     * ProductRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @param int $categoryId
     * @return Product[]
     */
    public function findByCategoryId(int $categoryId): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.categoryId = :val')
            ->setParameter('val', $categoryId)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $name
     * @param int $max
     * @return mixed
     */
    public function findByName(string $name, int $max): array
    {
        $name = mb_strtolower($name);
        $query = $this->createQueryBuilder('c')
            ->andWhere('LOWER(c.name) LIKE :name')
            ->setParameter('name', "{$name}%");

        if ($max > 0) {
            $query->setMaxResults($max);
        }

        return $query->select('c.id, c.name')->getQuery()->getResult();
    }
}