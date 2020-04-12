<?php

namespace App\Repository\Front;

use App\Entity\Front\SeoUrl;
use App\Repository\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SeoUrl|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeoUrl|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeoUrl[]    findAll()
 * @method SeoUrl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeoUrlRepository extends BaseRepository
{
    protected $entityManagerName = 'front';

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

    // /**
    //  * @return SeoUrl[] Returns an array of SeoUrl objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SeoUrl
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
