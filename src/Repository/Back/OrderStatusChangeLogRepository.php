<?php

namespace App\Repository\Back;

use App\Entity\Back\OrderStatusChangeLog;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderStatusChangeLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderStatusChangeLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderStatusChangeLog[]    findAll()
 * @method OrderStatusChangeLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderStatusChangeLog[]    findByIds(string $ids)
 * @method void    save(OrderStatusChangeLog $instance)
 * @method void    saveAndFlush(OrderStatusChangeLog $instance)
 * @method void    remove(OrderStatusChangeLog $instance)
 * @method void    removeAndFlush(OrderStatusChangeLog $instance)
 */
class OrderStatusChangeLogRepository extends EntityRepository
{
    protected $entityManagerName = 'back';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderStatusChangeLog::class);
    }

    // /**
    //  * @return OrderStatusChangeLog[] Returns an array of OrderStatusChangeLog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderStatusChangeLog
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
