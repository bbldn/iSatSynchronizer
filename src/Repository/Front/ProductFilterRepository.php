<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductFilter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method ProductFilter|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductFilter|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductFilter[]    findAll()
 * @method ProductFilter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductFilter[]    findByIds(string $ids)
 * @method void    persist(ProductFilter $instance)
 * @method void    persistAndFlush(ProductFilter $instance)
 * @method void    remove(ProductFilter $instance)
 * @method void    removeAndFlush(ProductFilter $instance)
 */
class ProductFilterRepository extends FrontRepository
{
    /**
     * ProductFilterRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, ProductFilter::class);
    }
}
