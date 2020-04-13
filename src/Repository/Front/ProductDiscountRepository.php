<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductDiscount;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductDiscount|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductDiscount|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductDiscount[]    findAll()
 * @method ProductDiscount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductDiscount[]    findByIds(string $ids)
 * @method void    save(ProductDiscount $instance)
 * @method void    saveAndFlush(ProductDiscount $instance)
 * @method void    remove(ProductDiscount $instance)
 * @method void    removeAndFlush(ProductDiscount $instance)
 */
class ProductDiscountRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductDiscount::class);
    }
}
