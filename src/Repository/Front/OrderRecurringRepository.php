<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderRecurring;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderRecurring|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderRecurring|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderRecurring[]    findAll()
 * @method OrderRecurring[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderRecurring[]    findByIds(string $ids)
 * @method void    save(OrderRecurring $instance)
 * @method void    saveAndFlush(OrderRecurring $instance)
 * @method void    remove(OrderRecurring $instance)
 * @method void    removeAndFlush(OrderRecurring $instance)
 */
class OrderRecurringRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderRecurring::class);
    }

    // /**
    //  * @return OrderRecurring[] Returns an array of OrderRecurring objects
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
    public function findOneBySomeField($value): ?OrderRecurring
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
