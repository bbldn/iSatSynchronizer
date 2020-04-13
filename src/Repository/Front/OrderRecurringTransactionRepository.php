<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderRecurringTransaction;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderRecurringTransaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderRecurringTransaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderRecurringTransaction[]    findAll()
 * @method OrderRecurringTransaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderRecurringTransaction[]    findByIds(string $ids)
 * @method void    save(OrderRecurringTransaction $instance)
 * @method void    saveAndFlush(OrderRecurringTransaction $instance)
 * @method void    remove(OrderRecurringTransaction $instance)
 * @method void    removeAndFlush(OrderRecurringTransaction $instance)
 */
class OrderRecurringTransactionRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderRecurringTransaction::class);
    }

    // /**
    //  * @return OrderRecurringTransaction[] Returns an array of OrderRecurringTransaction objects
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
    public function findOneBySomeField($value): ?OrderRecurringTransaction
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
