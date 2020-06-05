<?php

namespace App\Repository\Front;

use App\Entity\Front\Zone;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Zone|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zone|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zone[]    findAll()
 * @method Zone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZoneRepository extends FrontRepository
{
    /**
     * ZoneRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Zone::class);
    }

    /**
     * @param int $countryId
     * @param string $name
     * @return Zone|null
     */
    public function findOneByCountryIdAndName(int $countryId, string $name): ?Zone
    {
        try {
            $result = $this->createQueryBuilder('z')
                ->andWhere('z.countryId = :countryId')
                ->andWhere('z.name = :name')
                ->setParameter('countryId', $countryId)
                ->setParameter('name', $name)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $result = false;
        }

        return $result;
    }
}
