<?php

namespace App\Repository\Front;

use App\Entity\Front\Country;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

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
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Country::class);
    }

    /**
     * @param string $name
     * @return Country|null
     */
    public function findOneByCountry(string $name): ?Country
    {
        try {
            return $this->createQueryBuilder('c')
                ->andWhere('c.name = :name')
                ->setParameter('name', $name)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
