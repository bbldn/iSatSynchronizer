<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductImage;
use App\Other\Repository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductImage[]    findAll()
 * @method ProductImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductImage[]    findByIds(string $ids)
 * @method void    persist(ProductImage $instance)
 * @method void    persistAndFlush(ProductImage $instance)
 * @method void    remove(ProductImage $instance)
 * @method void    removeAndFlush(ProductImage $instance)
 */
class ProductImageRepository extends FrontRepository
{
    /**
     * ProductImageRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductImage::class);
    }
}
