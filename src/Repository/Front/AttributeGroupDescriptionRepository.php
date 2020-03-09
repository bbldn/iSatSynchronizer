<?php

namespace App\Repository\Front;

use App\Entity\Front\AttributeGroupDescription;
use App\Repository\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AttributeGroupDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributeGroupDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributeGroupDescription[]    findAll()
 * @method AttributeGroupDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributeGroupDescriptionRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeGroupDescription::class);
    }

    // /**
    //  * @return AttributeGroupDescription[] Returns an array of AttributeGroupDescription objects
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
    public function findOneBySomeField($value): ?AttributeGroupDescription
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
