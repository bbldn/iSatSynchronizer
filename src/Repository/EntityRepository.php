<?php

namespace App\Repository;

use App\Helper\ExceptionFormatter;
use Doctrine\DBAL\Connection;
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

    /**
     * @param string $ids
     * @return array
     */
    public function findByBackIds(string $ids): array
    {
        return $this->createQueryBuilder('c')
            ->where("c.backId IN (:ids)")
            ->setParameter('ids', explode(',', $ids), Connection::PARAM_INT_ARRAY)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $ids
     * @return array
     */
    public function findByFrontIds(string $ids): array
    {
        return $this->createQueryBuilder('c')
            ->where("c.frontId IN (:ids)")
            ->setParameter('ids', explode(',', $ids), Connection::PARAM_INT_ARRAY)
            ->getQuery()
            ->getResult();
    }
}