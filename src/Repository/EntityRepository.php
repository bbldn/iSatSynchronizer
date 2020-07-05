<?php

namespace App\Repository;

use App\Helper\ExceptionFormatter;
use Doctrine\ORM\NonUniqueResultException;

abstract class EntityRepository extends Repository
{
    /** @var string $entityManagerName */
    protected $entityManagerName = 'default';

    /**
     * @param int $value
     * @return mixed|null
     */
    public function findOneByBackId(int $value)
    {
        try {
            return $this->createQueryBuilder('c')
                ->andWhere('c.backId = :val')
                ->setParameter('val', $value)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }

    /**
     * @param int $value
     * @return mixed|null
     */
    public function findOneByFrontId(int $value)
    {
        try {
            return $this->createQueryBuilder('c')
                ->andWhere('c.frontId = :val')
                ->setParameter('val', $value)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }
}