<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGamePostAccounts;
use App\Repository\BaseRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuyersGamePostAccounts|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGamePostAccounts|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGamePostAccounts[]    findAll()
 * @method BuyersGamePostAccounts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuyersGamePostAccountsRepository extends BaseRepository
{
    protected $entityManagerName = 'back';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuyersGamePostAccounts::class);
    }

    // /**
    //  * @return BuyersGamePostAccounts[] Returns an array of BuyersGamePostAccounts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BuyersGamePostAccounts
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
