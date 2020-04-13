<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerOnline;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerOnline|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerOnline|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerOnline[]    findAll()
 * @method CustomerOnline[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerOnline[]    findByIds(string $ids)
 * @method void    save(CustomerOnline $instance)
 * @method void    saveAndFlush(CustomerOnline $instance)
 * @method void    remove(CustomerOnline $instance)
 * @method void    removeAndFlush(CustomerOnline $instance)
 */
class CustomerOnlineRepository extends EntityRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerOnline::class);
    }

    // /**
    //  * @return CustomerOnline[] Returns an array of CustomerOnline objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CustomerOnline
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
