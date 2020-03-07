<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Common\Persistence\ManagerRegistry;

class ProductRepository extends BaseRepository
{
    protected $entityManagerName = 'default';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findOneByBackId(int $value): ?Product
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.backId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneByFrontId(int $value): ?Product
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.frontId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}