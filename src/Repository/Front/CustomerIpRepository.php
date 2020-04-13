<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerIp;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerIp|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerIp|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerIp[]    findAll()
 * @method CustomerIp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerIp[]    findByIds(string $ids)
 * @method void    save(CustomerIp $instance)
 * @method void    saveAndFlush(CustomerIp $instance)
 * @method void    remove(CustomerIp $instance)
 * @method void    removeAndFlush(CustomerIp $instance)
 */
class CustomerIpRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerIp::class);
    }

    // /**
    //  * @return CustomerIp[] Returns an array of CustomerIp objects
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
    public function findOneBySomeField($value): ?CustomerIp
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
