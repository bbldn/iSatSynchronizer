<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerTransaction;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerTransaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerTransaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerTransaction[]    findAll()
 * @method CustomerTransaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerTransaction[]    findByIds(string $ids)
 * @method void    save(CustomerTransaction $instance)
 * @method void    saveAndFlush(CustomerTransaction $instance)
 * @method void    remove(CustomerTransaction $instance)
 * @method void    removeAndFlush(CustomerTransaction $instance)
 */
class CustomerTransactionRepository extends EntityRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerTransaction::class);
    }

    // /**
    //  * @return CustomerTransaction[] Returns an array of CustomerTransaction objects
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
    public function findOneBySomeField($value): ?CustomerTransaction
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
