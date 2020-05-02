<?php

namespace App\Repository\Front;

use App\Entity\Front\CategoryStore;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryStore|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryStore|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryStore[]    findAll()
 * @method CategoryStore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CategoryStore[]    findByIds(string $ids)
 * @method void    persist(CategoryStore $instance)
 * @method void    persistAndFlush(CategoryStore $instance)
 * @method void    remove(CategoryStore $instance)
 * @method void    removeAndFlush(CategoryStore $instance)
 */
class CategoryStoreRepository extends EntityFrontRepository
{
    /**
     * CategoryStoreRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryStore::class);
    }
}
