<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductOption;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method ProductOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductOption[]    findAll()
 * @method ProductOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductOption[]    findByIds(string $ids)
 * @method void    persist(ProductOption $instance)
 * @method void    persistAndFlush(ProductOption $instance)
 * @method void    remove(ProductOption $instance)
 * @method void    removeAndFlush(ProductOption $instance)
 */
class ProductOptionRepository extends FrontRepository
{
    /**
     * ProductOptionRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, ProductOption::class);
    }
}
