<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductReward;
use App\Helper\Repository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductReward|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductReward|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductReward[]    findAll()
 * @method ProductReward[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductReward[]    findByIds(string $ids)
 * @method void    persist(ProductReward $instance)
 * @method void    persistAndFlush(ProductReward $instance)
 * @method void    remove(ProductReward $instance)
 * @method void    removeAndFlush(ProductReward $instance)
 */
class ProductRewardRepository extends FrontRepository
{
    /**
     * ProductRewardRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductReward::class);
    }
}
