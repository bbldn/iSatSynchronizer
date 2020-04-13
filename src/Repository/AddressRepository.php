<?php

namespace App\Repository;

use App\Entity\Address;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Address|null find($id, $lockMode = null, $lockVersion = null)
 * @method Address|null findOneBy(array $criteria, array $orderBy = null)
 * @method Address[]    findAll()
 * @method Address[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Address[]    findByIds(string $ids)
 * @method void    save(Address $instance)
 * @method void    saveAndFlush(Address $instance)
 * @method void    remove(Address $instance)
 * @method void    removeAndFlush(Address $instance)
 */
class AddressRepository extends BaseRepository
{
    protected $entityManagerName = 'default';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Address::class);
    }

    public function findOneByOrderBackId(int $value): ?Address
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.orderBackId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneByFrontId(int $value): ?Address
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
