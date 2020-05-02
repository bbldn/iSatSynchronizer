<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductStore;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductStore|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductStore|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductStore[]    findAll()
 * @method ProductStore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductStore[]    findByIds(string $ids)
 * @method void    persist(ProductStore $instance)
 * @method void    persistAndFlush(ProductStore $instance)
 * @method void    remove(ProductStore $instance)
 * @method void    removeAndFlush(ProductStore $instance)
 */
class ProductStoreRepository extends EntityFrontRepository
{
    /**
     * ProductStoreRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductStore::class);
    }
}
