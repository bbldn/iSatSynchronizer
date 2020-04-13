<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerGroupDescription;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerGroupDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerGroupDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerGroupDescription[]    findAll()
 * @method CustomerGroupDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerGroupDescriptionRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerGroupDescription::class);
    }

    // /**
    //  * @return CustomerGroupDescription[] Returns an array of CustomerGroupDescription objects
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
    public function findOneBySomeField($value): ?CustomerGroupDescription
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
