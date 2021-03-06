<?php

namespace App\Repository\Front;

use App\Entity\Front\Zone;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

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
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Zone::class);
    }

    /**
     * @param int $countryId
     * @param string $name
     * @return Zone|null
     */
    public function findOneByCountryIdAndName(int $countryId, string $name): ?Zone
    {
        try {
            return $this->createQueryBuilder('z')
                ->andWhere('z.countryId = :countryId')
                ->andWhere('z.name = :name')
                ->setParameter('countryId', $countryId)
                ->setParameter('name', $name)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return null;
        }
    }

    /**
     * @return array
     */
    public function getZones(): array
    {
        return $this->createQueryBuilder('z')
            ->select('z.zoneId, z.ref')
            ->getQuery()
            ->getArrayResult();
    }
}
