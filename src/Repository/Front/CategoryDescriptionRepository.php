<?php

namespace App\Repository\Front;

use App\Entity\Front\CategoryDescription;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

/**
 * @method CategoryDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryDescription[]    findAll()
 * @method CategoryDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CategoryDescription[]    findByIds(string $ids)
 * @method void    persist(CategoryDescription $instance)
 * @method void    persistAndFlush(CategoryDescription $instance)
 * @method void    remove(CategoryDescription $instance)
 * @method void    removeAndFlush(CategoryDescription $instance)
 */
class CategoryDescriptionRepository extends FrontRepository
{
    /**
     * CategoryDescriptionRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, CategoryDescription::class);
    }

    /**
     * @param int $categoryId
     * @param int $languageId
     * @return CategoryDescription|null
     */
    public function findOneByCategoryFrontIdAndLanguageId(int $categoryId, int $languageId): ?CategoryDescription
    {
        try {
            return $this->createQueryBuilder('cd')
                ->andWhere('cd.categoryId = :categoryId')
                ->andWhere('cd.languageId = :languageId')
                ->setParameter('categoryId', $categoryId)
                ->setParameter('languageId', $languageId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }
}
