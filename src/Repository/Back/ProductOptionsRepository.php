<?php

namespace App\Repository\Back;

use App\Entity\Back\ProductOptions;
use Doctrine\Common\Persistence\ManagerRegistry;

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
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductOptions::class);
    }
}
