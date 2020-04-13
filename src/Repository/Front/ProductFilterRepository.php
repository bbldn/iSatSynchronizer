<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductFilter;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductFilter|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductFilter|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductFilter[]    findAll()
 * @method ProductFilter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductFilter[]    findByIds(string $ids)
 * @method void    save(ProductFilter $instance)
 * @method void    saveAndFlush(ProductFilter $instance)
 * @method void    remove(ProductFilter $instance)
 * @method void    removeAndFlush(ProductFilter $instance)
 */
class ProductFilterRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductFilter::class);
    }
}
