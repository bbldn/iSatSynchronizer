<?php

namespace App\Repository\Front;

use App\Entity\Front\Currency;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

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
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Currency::class);
    }

    /**
     * @param int $currencyId
     * @return float|null
     */
    public function getCurrentCurrency(int $currencyId): ?float
    {
        try {
            $result = $this->createQueryBuilder('c')
                ->andWhere('c.currencyId = :val')
                ->setParameter('val', $currencyId)
                ->select('SUM(c.value) as total')
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException $e) {
            $result = null;
        } catch (NonUniqueResultException $e) {
            $result = null;
        }

        return $result;
    }

    /**
     * @param string $code
     * @return Currency|null
     */
    public function findOneByCode(string $code): ?Currency
    {
        try {
            $result = $this->createQueryBuilder('c')
                ->andWhere('c.code = :val')
                ->setParameter('val', $code)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $result = null;
        }

        return $result;
    }
}
