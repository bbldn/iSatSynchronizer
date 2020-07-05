<?php

namespace App\Repository\Back;

use App\Entity\Back\ProductOptions;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method ProductOptions|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductOptions|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductOptions[]    findAll()
 * @method ProductOptions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductOptions[]    findByIds(string $ids)
 * @method void    persist(ProductOptions $instance)
 * @method void    persistAndFlush(ProductOptions $instance)
 * @method void    remove(ProductOptions $instance)
 * @method void    removeAndFlush(ProductOptions $instance)
 */
class ProductOptionsRepository extends BackRepository
{
    /**
     * ProductOptionsRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, ProductOptions::class);
    }
}
