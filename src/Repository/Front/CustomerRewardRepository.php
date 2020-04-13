<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerReward;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerReward|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerReward|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerReward[]    findAll()
 * @method CustomerReward[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerReward[]    findByIds(string $ids)
 * @method void    save(CustomerReward $instance)
 * @method void    saveAndFlush(CustomerReward $instance)
 * @method void    remove(CustomerReward $instance)
 * @method void    removeAndFlush(CustomerReward $instance)
 */
class CustomerRewardRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerReward::class);
    }

    // /**
    //  * @return CustomerReward[] Returns an array of CustomerReward objects
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
    public function findOneBySomeField($value): ?CustomerReward
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
