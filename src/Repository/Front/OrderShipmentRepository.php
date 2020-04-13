<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderShipment;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderShipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderShipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderShipment[]    findAll()
 * @method OrderShipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderShipment[]    findByIds(string $ids)
 * @method void    save(OrderShipment $instance)
 * @method void    saveAndFlush(OrderShipment $instance)
 * @method void    remove(OrderShipment $instance)
 * @method void    removeAndFlush(OrderShipment $instance)
 */
class OrderShipmentRepository extends EntityRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderShipment::class);
    }

    // /**
    //  * @return FrontOrderShipment[] Returns an array of FrontOrderShipment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FrontOrderShipment
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
