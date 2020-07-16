<?php

namespace App\Repository\Front;

use App\Entity\Front\Customer;
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
class CustomerRepository extends FrontRepository
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
     * @param string $val
     * @return Customer|null
     */
    public function findOneByEmail(string $val): ?Customer
    {
        try {
            return $this->createQueryBuilder('c')
                ->andWhere('c.email = :val')
                ->setParameter('val', $val)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return null;
        }
    }

    /**
     * @param string $val
     * @return Customer|null
     */
    public function findOneByPhone(string $val): ?Customer
    {
        try {
            return $this->createQueryBuilder('c')
                ->andWhere('c.phone = :val')
                ->setParameter('val', $val)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return null;
        }
    }
}
