<?php

namespace App\Repository\Front;

use App\Entity\Front\City;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

/**
 * @method City|null find($id, $lockMode = null, $lockVersion = null)
 * @method City|null findOneBy(array $criteria, array $orderBy = null)
 * @method City[]    findAll()
 * @method City[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method City[]    findByIds(string $ids)
 * @method void    persist(City $instance)
 * @method void    persistAndFlush(City $instance)
 * @method void    remove(City $instance)
 * @method void    removeAndFlush(City $instance)
 */
class CityRepository extends FrontRepository
{
    /**
     * AddressRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($registry, City::class);
    }

    /**
     * @param string $value
     * @return City|null
     */
    public function findOneByCode(string $value): ?City
    {
        try {
            return $this->createQueryBuilder('c')
                ->andWhere('c.code = :val')
                ->setParameter('val', $value)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}