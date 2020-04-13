<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductLayout;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductLayout|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductLayout|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductLayout[]    findAll()
 * @method ProductLayout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductLayout[]    findByIds(string $ids)
 * @method void    save(ProductLayout $instance)
 * @method void    saveAndFlush(ProductLayout $instance)
 * @method void    remove(ProductLayout $instance)
 * @method void    removeAndFlush(ProductLayout $instance)
 */
class ProductLayoutRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductLayout::class);
    }

    // /**
    //  * @return ProductLayout[] Returns an array of ProductLayout objects
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
    public function findOneBySomeField($value): ?ProductLayout
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
