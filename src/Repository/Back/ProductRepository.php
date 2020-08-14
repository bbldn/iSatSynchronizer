<?php

namespace App\Repository\Back;

use App\Entity\Back\Product;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product|null findOneFirst()
 * @method Product|null findOneLast()
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
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Product::class);
    }

    /**
     * @param int $categoryId
     * @return Product[]
     */
    public function findByCategoryId(int $categoryId): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.categoryId = :val')
            ->setParameter('val', $categoryId)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $name
     * @param int|null $max
     * @return array
     */
    public function getByNameWithMax(string $name, ?int $max): array
    {
        $name = mb_strtolower($name);
        $query = $this->createQueryBuilder('p')
            ->select('p.id, p.name')
            ->andWhere('LOWER(p.name) LIKE :name')
            ->setParameter('name', "{$name}%");

        if (null !== $max && $max > 0) {
            $query = $query->setMaxResults($max);
        }

        return $query->getQuery()->getArrayResult();
    }

    /**
     * @param string $name
     * @return Product[]
     */
    public function findByName(string $name): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.name LIKE :val')
            ->setParameter('val', "%$name%")
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    public function getIdsAll(): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.productId')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return array
     */
    public function getPricesAll(): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.productId, p.price, 1 as groupId')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param string $ids
     * @return array
     */
    public function getPricesByIds(string $ids): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.productId, p.price, 1 as groupId')
            ->andWhere('p.productId IN (:ids)')
            ->setParameter('ids', explode(',', $ids), Connection::PARAM_INT_ARRAY)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param string $ids
     * @return array
     */
    public function getPricesByCategoryIds(string $ids): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.productId, p.price')
            ->andWhere('p.categoryId IN (:ids)')
            ->setParameter('ids', explode(',', $ids), Connection::PARAM_INT_ARRAY)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return array
     */
    public function getAllSlugs(): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.slug')
            ->andWhere('LENGTH(p.slug) > 0')
            ->getQuery()
            ->getArrayResult();
    }
}