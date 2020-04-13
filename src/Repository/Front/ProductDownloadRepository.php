<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductDownload;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductDownload|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductDownload|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductDownload[]    findAll()
 * @method ProductDownload[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductDownload[]    findByIds(string $ids)
 * @method void    save(ProductDownload $instance)
 * @method void    saveAndFlush(ProductDownload $instance)
 * @method void    remove(ProductDownload $instance)
 * @method void    removeAndFlush(ProductDownload $instance)
 */
class ProductDownloadRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductDownload::class);
    }

    // /**
    //  * @return ProductDownload[] Returns an array of ProductDownload objects
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
    public function findOneBySomeField($value): ?ProductDownload
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
