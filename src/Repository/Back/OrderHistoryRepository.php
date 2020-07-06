<?php

namespace App\Repository\Back;

use App\Entity\Back\OrderHistory;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method OrderHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderHistory[]    findAll()
 * @method OrderHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderHistory[]    findByIds(string $ids)
 * @method void    persist(OrderHistory $instance)
 * @method void    persistAndFlush(OrderHistory $instance)
 * @method void    remove(OrderHistory $instance)
 * @method void    removeAndFlush(OrderHistory $instance)
 */
class OrderHistoryRepository extends BackRepository
{
    /**
     * OrderHistoryRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, OrderHistory::class);
    }

    /**
     * @param int $value
     * @return bool
     */
    public function existsByOrderNum(int $value): bool
    {
        return $this->createQueryBuilder('oh')
                ->select('count(oh.id)')
                ->andWhere('oh.orderNum = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getScalarResult() > 0;
    }
}
