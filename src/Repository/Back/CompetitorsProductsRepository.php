<?php

namespace App\Repository\Back;

use App\Entity\Back\CompetitorsProducts;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

/**
 * @method CompetitorsProducts|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetitorsProducts|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetitorsProducts[]    findAll()
 * @method CompetitorsProducts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CompetitorsProducts[]    findByIds(string $ids)
 * @method void    persist(CompetitorsProducts $instance)
 * @method void    persistAndFlush(CompetitorsProducts $instance)
 * @method void    remove(CompetitorsProducts $instance)
 * @method void    removeAndFlush(CompetitorsProducts $instance)
 */
class CompetitorsProductsRepository extends BackRepository
{
    /**
     * CompetitorsProductsRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, CompetitorsProducts::class);
    }

    /**
     * @param int $competitorId
     * @param int $productId
     * @return CompetitorsProducts|null
     */
    public function findOneByCompetitorIdAndProductId(int $competitorId, int $productId): ?CompetitorsProducts
    {
        try {
            return $this->createQueryBuilder('cp')
                ->andWhere('cp.competitorId = :competitorId')
                ->andWhere('cp.productId = :productId')
                ->setParameter('competitorId', $competitorId)
                ->setParameter('productId', $productId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }
}