<?php

namespace App\Repository\Front;

use App\Entity\Front\AttributeGroup;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AttributeGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributeGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributeGroup[]    findAll()
 * @method AttributeGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method AttributeGroup[]    findByIds(string $ids)
 * @method void    save(AttributeGroup $instance)
 * @method void    saveAndFlush(AttributeGroup $instance)
 * @method void    remove(AttributeGroup $instance)
 * @method void    removeAndFlush(AttributeGroup $instance)
 */
class AttributeGroupRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeGroup::class);
    }

    // /**
    //  * @return AttributeGroup[] Returns an array of AttributeGroup objects
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
    public function findOneBySomeField($value): ?AttributeGroup
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
