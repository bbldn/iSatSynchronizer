<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerOnline;
use App\Repository\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerOnline|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerOnline|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerOnline[]    findAll()
 * @method CustomerOnline[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerOnlineRepository extends BaseRepository
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
