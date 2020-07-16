<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Customer[]    findByIds(string $ids)
 * @method void    persist(Customer $instance)
 * @method void    persistAndFlush(Customer $instance)
 * @method void    remove(Customer $instance)
 * @method void    removeAndFlush(Customer $instance)
 */
class CustomerRepository extends EntityRepository
{
    /**
     * CustomerRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Customer::class);
    }

    /**
     * @param int $value
     * @return Customer|null
     */
    public function findOneByBackId(int $value): ?Customer
    {
        try {
            return $this->createQueryBuilder('c')
                ->andWhere('c.backId = :val')
                ->setParameter('val', $value)
                ->andWhere('c.isOrder = false')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return null;
        }
    }

    /**
     * @param int $value
     * @return Customer|null
     */
    public function findOneByFrontId(int $value): ?Customer
    {
        try {
            return $this->createQueryBuilder('c')
                ->andWhere('c.frontId = :val')
                ->setParameter('val', $value)
                ->andWhere('c.isOrder = false')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return null;
        }
    }

    /**
     * @param int $value
     * @return Customer|null
     */
    public function findOneByFrontIdAndOrder(int $value): ?Customer
    {
        try {
            return $this->createQueryBuilder('c')
                ->andWhere('c.frontId = :val')
                ->setParameter('val', $value)
                ->andWhere('c.isOrder = true')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return null;
        }
    }
}
