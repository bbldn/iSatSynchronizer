<?php

namespace App\Repository;

use App\Entity\Address;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

/**
 * @method Address|null find($id, $lockMode = null, $lockVersion = null)
 * @method Address|null findOneBy(array $criteria, array $orderBy = null)
 * @method Address[]    findAll()
 * @method Address[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Address[]    findByIds(string $ids)
 * @method void    persist(Address $instance)
 * @method void    persistAndFlush(Address $instance)
 * @method void    remove(Address $instance)
 * @method void    removeAndFlush(Address $instance)
 * @method Address|null    findOneByFrontId(int $value)
 */
class AddressRepository extends EntityRepository
{
    /**
     * AddressRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Address::class);
    }

    /**
     * @param int $value
     * @return Address|null
     */
    public function findOneByBackId(int $value): ?Address
    {
        return $this->findOneByOrderBackId($value);
    }

    /**
     * @param int $value
     * @return Address|null
     */
    public function findOneByOrderBackId(int $value): ?Address
    {
        try {
            return $this->createQueryBuilder('c')
                ->andWhere('c.customerBackId = :val')
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
