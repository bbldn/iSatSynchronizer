<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product|[]    findAll()
 * @method Product|[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Product[]    findByIds(string $ids)
 * @method void    persist(Product $instance)
 * @method void    persistAndFlush(Product $instance)
 * @method void    remove(Product $instance)
 * @method void    removeAndFlush(Product $instance)
 * @method Product|null findOneByBackId(int $value)
 * @method Product|null findOneByFrontId(int $value)
 */
class ProductRepository extends EntityRepository
{
    /**
     * ProductRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Product::class);
    }
}