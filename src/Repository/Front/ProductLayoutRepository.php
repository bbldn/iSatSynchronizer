<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductLayout;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductLayout|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductLayout|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductLayout[]    findAll()
 * @method ProductLayout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductLayout[]    findByIds(string $ids)
 * @method void    persist(ProductLayout $instance)
 * @method void    persistAndFlush(ProductLayout $instance)
 * @method void    remove(ProductLayout $instance)
 * @method void    removeAndFlush(ProductLayout $instance)
 */
class ProductLayoutRepository extends FrontRepository
{
    /**
     * ProductLayoutRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductLayout::class);
    }
}
