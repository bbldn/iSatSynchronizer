<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGroupsPrices;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

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
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, BuyersGroupsPrices::class);
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

    /**
     * @return array
     */
    public function getPricesAll(): array
    {
        return $this->createQueryBuilder('bgp')
            ->select('bgp.productId, bgp.price, bgp.groupId')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param string $ids
     * @return array
     */
    public function getPricesByIds(string $ids): array
    {
        return $this->createQueryBuilder('bgp')
            ->select('bgp.productId, bgp.price, bgp.groupId')
            ->andWhere('bgp.productId IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getArrayResult();
    }
}
