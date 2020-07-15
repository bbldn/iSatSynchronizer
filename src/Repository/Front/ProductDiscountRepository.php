<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductDiscount;
use App\Helper\ExceptionFormatter;
use App\Repository\ProductRepository as ProductRepositoryMain;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

/**
 * @method ProductDiscount|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductDiscount|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductDiscount[]    findAll()
 * @method ProductDiscount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductDiscount[]    findByIds(string $ids)
 * @method void    persist(ProductDiscount $instance)
 * @method void    persistAndFlush(ProductDiscount $instance)
 * @method void    remove(ProductDiscount $instance)
 * @method void    removeAndFlush(ProductDiscount $instance)
 */
class ProductDiscountRepository extends FrontRepository
{
    /** @var ProductRepository $productRepository */
    protected $productRepository;

    /** @var string $dataBaseName */
    protected $dataBaseName;

    /** @var string $dataBaseNameFront */
    protected $dataBaseNameFront;

    /**
     * ProductDiscountRepository constructor.
     * @param ManagerRegistry $registry
     * @param ProductRepositoryMain $productRepository
     * @param LoggerInterface $logger
     * @param string $dataBaseName
     * @param string $dataBaseNameFront
     */
    public function __construct(
        ManagerRegistry $registry,
        ProductRepositoryMain $productRepository,
        LoggerInterface $logger,
        string $dataBaseName,
        string $dataBaseNameFront
    )
    {
        $this->productRepository = $productRepository;
        $this->dataBaseName = $dataBaseName;
        $this->dataBaseNameFront = $dataBaseNameFront;
        parent::__construct($logger, $registry, ProductDiscount::class);
    }

    /**
     * @param int $customerGroupId
     * @param int $productId
     * @return ProductDiscount|null
     */
    public function findOneByCustomerGroupIdAndProductId(int $customerGroupId, int $productId): ?ProductDiscount
    {
        try {
            return $this->createQueryBuilder('ps')
                ->andWhere('ps.customerGroupId = :customerGroupId')
                ->andWhere('ps.productId = :productId')
                ->setParameter('customerGroupId', $customerGroupId)
                ->setParameter('productId', $productId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }

    /**
     * @param array $values
     * @return bool
     */
    public function updatePriceByValues(array $values): bool
    {
        $tableNameFront = $this->getClassMetadata()->getTableName();
        $tableName = $this->productRepository->getClassMetadata()->getTableName();

        $sql = '';
        foreach ($values as $value) {
            /* @noinspection SqlNoDataSourceInspection */
            $sql .= "
              UPDATE
                  {$this->dataBaseNameFront}.{$tableNameFront} ps
              INNER JOIN 
                  {$this->dataBaseName}.{$tableName} p ON ps.product_id = p.front_id
              SET
                  ps.price = {$value['price']}
              WHERE
                  p.back_id = {$value['productId']}
              AND
                  ps.customer_group_id = {$value['groupId']};
            ";
        }

        try {
            $result = $this->getEntityManager()->getConnection()->prepare($sql)->execute();
        } catch (DBALException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            $result = false;
        }

        return $result;
    }
}
