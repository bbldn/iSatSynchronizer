<?php

namespace App\Repository;

use App\Entity\Address;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

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
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Address::class);
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
            $result = $this->createQueryBuilder('c')
                ->andWhere('c.customerBackId = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $result = null;
        }

        return $result;
    }
}
