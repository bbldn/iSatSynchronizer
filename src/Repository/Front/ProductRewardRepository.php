<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductReward;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductReward|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductReward|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductReward[]    findAll()
 * @method ProductReward[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductReward[]    findByIds(string $ids)
 * @method void    save(ProductReward $instance)
 * @method void    saveAndFlush(ProductReward $instance)
 * @method void    remove(ProductReward $instance)
 * @method void    removeAndFlush(ProductReward $instance)
 */
class ProductRewardRepository extends EntityRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductReward::class);
    }

    // /**
    //  * @return ProductReward[] Returns an array of ProductReward objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductReward
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
