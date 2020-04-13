<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Customer[]    findByIds(string $ids)
 * @method void    save(Customer $instance)
 * @method void    saveAndFlush(Customer $instance)
 * @method void    remove(Customer $instance)
 * @method void    removeAndFlush(Customer $instance)
 */
class CustomerRepository extends BaseRepository
{
    protected $entityManagerName = 'default';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    public function findOneByBackId(int $value): ?Customer
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.backId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneByFrontId(int $value): ?Customer
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.frontId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
    // /**
    //  * @return Attribute[] Returns an array of Attribute objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Attribute
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
