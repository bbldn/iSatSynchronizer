<?php

namespace App\Repository\Front;

use App\Entity\Front\AttributeDescription;
use App\Repository\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AttributeDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributeDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributeDescription[]    findAll()
 * @method AttributeDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributeDescriptionRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeDescription::class);
    }

    // /**
    //  * @return AttributeDescription[] Returns an array of AttributeDescription objects
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
    public function findOneBySomeField($value): ?AttributeDescription
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
