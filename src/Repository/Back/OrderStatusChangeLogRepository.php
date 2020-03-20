<?php

namespace App\Repository\Back;

use App\Entity\Back\OrderStatusChangeLog;
use App\Repository\BaseRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderStatusChangeLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderStatusChangeLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderStatusChangeLog[]    findAll()
 * @method OrderStatusChangeLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderStatusChangeLogRepository extends BaseRepository
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
