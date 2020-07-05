<?php

namespace App\Repository\Front;

use App\Entity\Front\SeoUrl;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

/**
 * @method SeoUrl|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeoUrl|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeoUrl[]    findAll()
 * @method SeoUrl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method SeoUrl[]    findByIds(string $ids)
 * @method void    persist(SeoUrl $instance)
 * @method void    persistAndFlush(SeoUrl $instance)
 * @method void    remove(SeoUrl $instance)
 * @method void    removeAndFlush(SeoUrl $instance)
 */
class SeoUrlRepository extends FrontRepository
{
    /**
     * SeoUrlRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, SeoUrl::class);
    }

    /**
     * @param string $query
     * @param int $languageId
     * @return SeoUrl|null
     */
    public function findOneByQueryAndLanguageId(string $query, int $languageId): ?SeoUrl
    {
        try {
            return $this->createQueryBuilder('su')
                ->andWhere('su.query = :query')
                ->andWhere('su.languageId = :languageId')
                ->setParameter('query', $query)
                ->setParameter('languageId', $languageId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }

    /**
     * @param string $query
     * @return mixed
     */
    public function removeAllByQuery(string $query)
    {
        return $this->createQueryBuilder('c')
            ->where("c.query LIKE '{$query}%'")
            ->delete()
            ->getQuery()
            ->execute();
    }
}
