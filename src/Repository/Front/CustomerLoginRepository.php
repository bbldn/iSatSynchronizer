<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerLogin;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerLogin|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerLogin|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerLogin[]    findAll()
 * @method CustomerLogin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerLogin[]    findByIds(string $ids)
 * @method void    save(CustomerLogin $instance)
 * @method void    saveAndFlush(CustomerLogin $instance)
 * @method void    remove(CustomerLogin $instance)
 * @method void    removeAndFlush(CustomerLogin $instance)
 */
class CustomerLoginRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerLogin::class);
    }

    // /**
    //  * @return CustomerLogin[] Returns an array of CustomerLogin objects
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
    public function findOneBySomeField($value): ?CustomerLogin
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
