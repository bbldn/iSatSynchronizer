<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderCustomField;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderCustomField|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderCustomField|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderCustomField[]    findAll()
 * @method OrderCustomField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderCustomField[]    findByIds(string $ids)
 * @method void    save(OrderCustomField $instance)
 * @method void    saveAndFlush(OrderCustomField $instance)
 * @method void    remove(OrderCustomField $instance)
 * @method void    removeAndFlush(OrderCustomField $instance)
 */
class OrderCustomFieldRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderCustomField::class);
    }

    // /**
    //  * @return OrderCustomField[] Returns an array of OrderCustomField objects
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
    public function findOneBySomeField($value): ?OrderCustomField
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
