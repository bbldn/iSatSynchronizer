<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductDescription;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductDescription[]    findAll()
 * @method ProductDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductDescription[]    findByIds(string $ids)
 * @method void    save(ProductDescription $instance)
 * @method void    saveAndFlush(ProductDescription $instance)
 * @method void    remove(ProductDescription $instance)
 * @method void    removeAndFlush(ProductDescription $instance)
 */
class ProductDescriptionRepository extends EntityRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductDescription::class);
    }

    // /**
    //  * @return ProductDescription[] Returns an array of ProductDescription objects
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
    public function findOneBySomeField($value): ?ProductDescription
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
