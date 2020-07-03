<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductDiscount;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

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
    /**
     * ProductDiscountRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductDiscount::class);
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
            return null;
        }
    }

//    public function updatePriceByData(array $data): bool
//    {
//        $tableName = $this->productRepository->getClassMetadata()->getTableName();
//        $tableNameFront = $this->getClassMetadata()->getTableName();
//
//        $sql = '';
//        foreach ($data as $value) {
//            $sql .= "
//              UPDATE
//                  {$this->dataBaseNameFront}.{$tableNameFront} pf
//              INNER JOIN {$this->dataBaseName}.{$tableName} p ON pf.product_id = p.front_id
//              SET
//                  pf.price = {$value['price']}
//              WHERE
//                  p.back_id = {$value['product_id']};
//            ";
//        }
//
//        try {
//            $result = $this->getEntityManager()->getConnection()->prepare($sql)->execute();
//        } catch (DBALException $e) {
//            $result = false;
//        }
//
//        return $result;
//    }
}
