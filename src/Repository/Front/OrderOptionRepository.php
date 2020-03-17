<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderOption;
use App\Repository\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderOption[]    findAll()
 * @method OrderOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderOptionRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderOption::class);
    }

    // /**
    //  * @return OrderOption[] Returns an array of OrderOption objects
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
    public function findOneBySomeField($value): ?OrderOption
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
