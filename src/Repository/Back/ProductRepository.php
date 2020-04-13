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
 * @method void    save(Product $instance)
 * @method void    saveAndFlush(Product $instance)
 * @method void    remove(Product $instance)
 * @method void    removeAndFlush(Product $instance)
 */
class ProductRepository extends EntityBackRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @param int $categoryId
     * @return Product[] Returns an array of Product objects
     */
    public function findByCategoryId(int $categoryId)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.categoryId = :val')
            ->setParameter('val', $categoryId)
            ->getQuery()
            ->getResult();
    }
}