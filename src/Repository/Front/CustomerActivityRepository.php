<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerActivity;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerActivity[]    findAll()
 * @method CustomerActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerActivity[]    findByIds(string $ids)
 * @method void    save(CustomerActivity $instance)
 * @method void    saveAndFlush(CustomerActivity $instance)
 * @method void    remove(CustomerActivity $instance)
 * @method void    removeAndFlush(CustomerActivity $instance)
 */
class CustomerActivityRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerActivity::class);
    }

    // /**
    //  * @return CustomerActivity[] Returns an array of CustomerActivity objects
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
    public function findOneBySomeField($value): ?CustomerActivity
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
