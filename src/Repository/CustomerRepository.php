<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

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
 * @method Customer|null    findOneByBackId(int $value)
 * @method Customer|null    findOneByFrontId(int $value)
 */
class CustomerRepository extends EntityRepository
{
    /**
     * CustomerRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
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
            return null;
        }
    }
}
