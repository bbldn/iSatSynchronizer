<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductOptionValue;
use App\Other\Repository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductOptionValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductOptionValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductOptionValue[]    findAll()
 * @method ProductOptionValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductOptionValue[]    findByIds(string $ids)
 * @method void    persist(ProductOptionValue $instance)
 * @method void    persistAndFlush(ProductOptionValue $instance)
 * @method void    remove(ProductOptionValue $instance)
 * @method void    removeAndFlush(ProductOptionValue $instance)
 */
class ProductOptionValueRepository extends FrontRepository
{
    /**
     * ProductOptionValueRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductOptionValue::class);
    }
}
