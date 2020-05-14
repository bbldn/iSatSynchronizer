<?php

namespace App\Repository\Back;

use App\Entity\Back\ProductOptionsValues;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductOptionsValues|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductOptionsValues|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductOptionsValues[]    findAll()
 * @method ProductOptionsValues[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductOptionsValues[]    findByIds(string $ids)
 * @method void    persist(ProductOptionsValues $instance)
 * @method void    persistAndFlush(ProductOptionsValues $instance)
 * @method void    remove(ProductOptionsValues $instance)
 * @method void    removeAndFlush(ProductOptionsValues $instance)
 */
class ProductOptionsValuesRepository extends BackRepository
{
    /**
     * ProductOptionsValuesRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductOptionsValues::class);
    }

    /**
     * @param $value
     * @return ProductOptionsValues[]
     */
    public function findAllByProductBackId($value): array
    {
        return $this->createQueryBuilder('po')
            ->andWhere('po.productId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }
}
