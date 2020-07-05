<?php

namespace App\Repository\Front;

use App\Entity\Front\Country;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

/**
 * @method Country|null find($id, $lockMode = null, $lockVersion = null)
 * @method Country|null findOneBy(array $criteria, array $orderBy = null)
 * @method Country[]    findAll()
 * @method Country[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountryRepository extends FrontRepository
{
    /**
     * CountryRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Country::class);
    }

    /**
     * @param string $name
     * @return Country|null
     */
    public function findOneByName(string $name): ?Country
    {
        try {
            return $this->createQueryBuilder('c')
                ->andWhere('c.name = :name')
                ->setParameter('name', $name)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }

    /**
     * @return array
     */
    public function getCountries(): array
    {
        return $this->createQueryBuilder('c')
            ->select('c.countryId, c.name')
            ->getQuery()
            ->getArrayResult();
    }
}
