<?php

namespace App\Repository\Back;

use App\Entity\Back\Product;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;

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
    public function findByNameWithMax(string $name, ?int $max): array
    {
        $name = mb_strtolower($name);
        $query = $this->createQueryBuilder('p')
            ->andWhere('LOWER(p.name) LIKE :name')
            ->setParameter('name', "{$name}%");

        if (null !== $max && $max > 0) {
            $query->setMaxResults($max);
        }

        return $query->select('p.id, p.name')->getQuery()->getResult();
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
    public function getAllIds(): array
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
            ->andWhere('p.productId IN (:ids})')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param string $ids
     * @return array
     */
    public function getBackPricesByCategoryIds(string $ids): array
    {
        $tableName = $this->getClassMetadata()->getTableName();
        $queryBuilder = $this->getEntityManager()->getConnection()->createQueryBuilder();
        $queryBuilder->select('p.`productID` as `product_id`, p.`Price` as `price`');
        $queryBuilder->from($tableName, 'p');
        $queryBuilder->where("p.`categoryID` IN ({$ids})");

        try {
            $result = $this->getEntityManager()->getConnection()->prepare($queryBuilder->getSQL());
        } catch (DBALException $e) {
            return [];
        }

        $result->execute();

        return $result->fetchAll();
    }

    /**
     * @return array
     */
    public function getAllSlugs(): array
    {
        $tableName = $this->getClassMetadata()->getTableName();
        $queryBuilder = $this->getEntityManager()->getConnection()->createQueryBuilder();
        $queryBuilder->select('p.`slug` as `slug`');
        $queryBuilder->from($tableName, 'p');
        $queryBuilder->where('CHAR_LENGTH(p.`slug`) > 0');

        try {
            $result = $this->getEntityManager()->getConnection()->prepare($queryBuilder->getSQL());
        } catch (DBALException $e) {
            return [];
        }

        $result->execute();

        return $result->fetchAll();
    }
}