<?php

namespace App\Repository\Front;

use App\Entity\Front\Manufacturer;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Manufacturer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Manufacturer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Manufacturer[]    findAll()
 * @method Manufacturer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ManufacturerRepository extends FrontRepository
{
    /**
     * ManufacturerRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Manufacturer::class);
    }

    /**
     * @param string $name
     * @return Manufacturer|null
     */
    public function findOneByName(string $name): ?Manufacturer
    {
        try {
            return $this->createQueryBuilder('m')
                ->andWhere('m.name = :val')
                ->setParameter('val', $name)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
