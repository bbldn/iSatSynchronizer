<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductRecurring;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method ProductRecurring|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductRecurring|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductRecurring[]    findAll()
 * @method ProductRecurring[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductRecurring[]    findByIds(string $ids)
 * @method void    persist(ProductRecurring $instance)
 * @method void    persistAndFlush(ProductRecurring $instance)
 * @method void    remove(ProductRecurring $instance)
 * @method void    removeAndFlush(ProductRecurring $instance)
 */
class ProductRecurringRepository extends FrontRepository
{
    /**
     * ProductRecurringRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, ProductRecurring::class);
    }
}
