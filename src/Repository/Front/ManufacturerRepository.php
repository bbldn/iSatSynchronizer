<?php

namespace App\Repository\Front;

use App\Entity\Front\Manufacturer;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

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
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Manufacturer::class);
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
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }
}
