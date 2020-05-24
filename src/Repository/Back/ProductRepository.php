<?php

namespace App\Repository\Back;

use App\Entity\Back\Product;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

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
    /** @var ContainerBagInterface $containerBag */
    protected $containerBag;

    /**
     * ProductRepository constructor.
     * @param ManagerRegistry $registry
     * @param ContainerBagInterface $containerBag
     */
    public function __construct(ManagerRegistry $registry, ContainerBagInterface $containerBag)
    {
        $this->containerBag = $containerBag;
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

    /**
     * @return array
     */
    public function getBackPrices(): array
    {
        $tableName = $this->getClassMetadata()->getTableName();
        $queryBuilder = $this->getEntityManager()->getConnection()->createQueryBuilder();
        $queryBuilder->select('p.`productID` as `product_id`, p.`Price` as `price`');
        $queryBuilder->from($tableName, 'p');

        try {
            $result = $this->getEntityManager()->getConnection()->prepare($queryBuilder->getSQL());
        } catch (DBALException $e) {
            return [];
        }

        $result->execute();

        return $result->fetchAll();
    }

    /**
     * @param string $ids
     * @return array
     */
    public function getBackPricesByIds(string $ids): array
    {
        $tableName = $this->getClassMetadata()->getTableName();
        $queryBuilder = $this->getEntityManager()->getConnection()->createQueryBuilder();
        $queryBuilder->select('p.`productID` as `product_id`, p.`Price` as `price`');
        $queryBuilder->from($tableName, 'p');
        $queryBuilder->where("p.`productID` IN ({$ids})");

        try {
            $result = $this->getEntityManager()->getConnection()->prepare($queryBuilder->getSQL());
        } catch (DBALException $e) {
            return [];
        }

        $result->execute();

        return $result->fetchAll();
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
}