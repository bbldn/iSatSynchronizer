<?php

namespace App\Repository\Back;

use App\Entity\Back\OrderHistory;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderHistory[]    findAll()
 * @method OrderHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderHistory[]    findByIds(string $ids)
 * @method void    save(OrderHistory $instance)
 * @method void    saveAndFlush(OrderHistory $instance)
 * @method void    remove(OrderHistory $instance)
 * @method void    removeAndFlush(OrderHistory $instance)
 */
class OrderHistoryRepository extends EntityBackRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderHistory::class);
    }
}
