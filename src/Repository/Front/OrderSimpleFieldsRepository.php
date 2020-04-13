<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderSimpleFields;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderSimpleFields|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderSimpleFields|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderSimpleFields[]    findAll()
 * @method OrderSimpleFields[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderSimpleFields[]    findByIds(string $ids)
 * @method void    save(OrderSimpleFields $instance)
 * @method void    saveAndFlush(OrderSimpleFields $instance)
 * @method void    remove(OrderSimpleFields $instance)
 * @method void    removeAndFlush(OrderSimpleFields $instance)
 */
class OrderSimpleFieldsRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderSimpleFields::class);
    }

    // /**
    //  * @return OrderSimpleFields[] Returns an array of OrderSimpleFields objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderSimpleFields
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
