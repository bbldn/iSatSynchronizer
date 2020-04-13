<?php

namespace App\Repository\Front;

use App\Entity\Front\SeoUrl;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SeoUrl|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeoUrl|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeoUrl[]    findAll()
 * @method SeoUrl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method SeoUrl[]    findByIds(string $ids)
 * @method void    save(SeoUrl $instance)
 * @method void    saveAndFlush(SeoUrl $instance)
 * @method void    remove(SeoUrl $instance)
 * @method void    removeAndFlush(SeoUrl $instance)
 */
class SeoUrlRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SeoUrl::class);
    }

    public function findOneByQueryAndLanguageId(string $query, int $languageId): ?SeoUrl
    {
        return $this->createQueryBuilder('su')
            ->andWhere('su.query = :query')
            ->andWhere('su.query = :languageId')
            ->setParameter('query', $query)
            ->setParameter('languageId', $languageId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function removeAllByQuery(string $query)
    {
        return $this->createQueryBuilder('c')
            ->where("c.query LIKE {$query}%")
            ->delete()
            ->getQuery()
            ->execute();
    }
}
