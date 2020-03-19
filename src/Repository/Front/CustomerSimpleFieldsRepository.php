<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerSimpleFields;
use App\Repository\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerSimpleFields|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerSimpleFields|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerSimpleFields[]    findAll()
 * @method CustomerSimpleFields[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerSimpleFieldsRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerSimpleFields::class);
    }

    // /**
    //  * @return CustomerSimpleFields[] Returns an array of CustomerSimpleFields objects
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
    public function findOneBySomeField($value): ?CustomerSimpleFields
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
