<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGamePostAccounts;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuyersGamePostAccounts|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGamePostAccounts|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGamePostAccounts[]    findAll()
 * @method BuyersGamePostAccounts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method BuyersGamePostAccounts[]    findByIds(string $ids)
 * @method void    save(BuyersGamePostAccounts $instance)
 * @method void    saveAndFlush(BuyersGamePostAccounts $instance)
 * @method void    remove(BuyersGamePostAccounts $instance)
 * @method void    removeAndFlush(BuyersGamePostAccounts $instance)
 */
class BuyersGamePostAccountsRepository extends EntityRepository
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
