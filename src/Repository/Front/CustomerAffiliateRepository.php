<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerAffiliate;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerAffiliate|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerAffiliate|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerAffiliate[]    findAll()
 * @method CustomerAffiliate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerAffiliate[]    findByIds(string $ids)
 * @method void    save(CustomerAffiliate $instance)
 * @method void    saveAndFlush(CustomerAffiliate $instance)
 * @method void    remove(CustomerAffiliate $instance)
 * @method void    removeAndFlush(CustomerAffiliate $instance)
 */
class CustomerAffiliateRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerAffiliate::class);
    }

    // /**
    //  * @return CustomerAffiliate[] Returns an array of CustomerAffiliate objects
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
    public function findOneBySomeField($value): ?CustomerAffiliate
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
