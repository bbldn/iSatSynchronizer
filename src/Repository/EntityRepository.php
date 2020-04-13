<?php

namespace App\Repository;

use App\Other\EntityRepository as BaseRepository;

class EntityRepository extends BaseRepository
{
    protected $entityManagerName = 'default';

    public function findOneByBackId(int $value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.backId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneByFrontId(int $value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.frontId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}