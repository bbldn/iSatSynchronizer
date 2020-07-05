<?php

namespace App\Repository\Front;

use App\Entity\Front\Currency;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\UnexpectedResultException;
use Psr\Log\LoggerInterface;

/**
 * @method Currency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Currency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Currency[]    findAll()
 * @method Currency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Currency[]    findByIds(string $ids)
 * @method void    persist(Currency $instance)
 * @method void    persistAndFlush(Currency $instance)
 * @method void    remove(Currency $instance)
 * @method void    removeAndFlush(Currency $instance)
 */
class CurrencyRepository extends FrontRepository
{
    /**
     * CurrencyRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Currency::class);
    }

    /**
     * @param int $currencyId
     * @return float|null
     */
    public function getCurrentCurrency(int $currencyId): ?float
    {
        try {
            return $this->createQueryBuilder('c')
                ->select('SUM(c.value) as total')
                ->andWhere('c.currencyId = :val')
                ->setParameter('val', $currencyId)
                ->setMaxResults(1)
                ->getQuery()
                ->getSingleScalarResult();
        } catch (UnexpectedResultException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }

    /**
     * @param string $code
     * @return Currency|null
     */
    public function findOneByCode(string $code): ?Currency
    {
        try {
            return $this->createQueryBuilder('c')
                ->andWhere('c.code = :val')
                ->setParameter('val', $code)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }
}
