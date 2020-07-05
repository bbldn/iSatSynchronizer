<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductRelated;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method ProductRelated|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductRelated|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductRelated[]    findAll()
 * @method ProductRelated[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductRelated[]    findByIds(string $ids)
 * @method void    persist(ProductRelated $instance)
 * @method void    persistAndFlush(ProductRelated $instance)
 * @method void    remove(ProductRelated $instance)
 * @method void    removeAndFlush(ProductRelated $instance)
 */
class ProductRelatedRepository extends FrontRepository
{
    /**
     * ProductRelatedRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, ProductRelated::class);
    }
}
