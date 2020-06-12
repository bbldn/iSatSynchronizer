<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGroupsPrices;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuyersGroupsPrices|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGroupsPrices|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGroupsPrices[]    findAll()
 * @method BuyersGroupsPrices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method BuyersGroupsPrices[]    findByIds(string $ids)
 * @method void    persist(BuyersGroupsPrices $instance)
 * @method void    persistAndFlush(BuyersGroupsPrices $instance)
 * @method void    remove(BuyersGroupsPrices $instance)
 * @method void    removeAndFlush(BuyersGroupsPrices $instance)
 */
class BuyersGroupsPricesRepository extends BackRepository
{
    /**
     * BuyersGroupsPricesRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuyersGroupsPrices::class);
    }

    /**
     * @param int $productBackId
     * @return BuyersGroupsPrices[]
     */
    public function findByProductBackId(int $productBackId): array
    {
        return $this->createQueryBuilder('bgp')
            ->andWhere('bgp.productId = :productBackId')
            ->setParameter('productBackId', $productBackId)
            ->andWhere('bgp.groupId < :groupId')
            ->setParameter('groupId', 5)
            ->getQuery()
            ->getResult();
    }
}
