<?php

namespace App\Repository\Front;

use App\Entity\Front\CategoryLayout;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

/**
 * @method CategoryLayout|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryLayout|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryLayout[]    findAll()
 * @method CategoryLayout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CategoryLayout[]    findByIds(string $ids)
 * @method void    persist(CategoryLayout $instance)
 * @method void    persistAndFlush(CategoryLayout $instance)
 * @method void    remove(CategoryLayout $instance)
 * @method void    removeAndFlush(CategoryLayout $instance)
 */
class CategoryLayoutRepository extends FrontRepository
{
    /**
     * CategoryLayoutRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, CategoryLayout::class);
    }

    /**
     * @param int $categoryId
     * @param int $storeId
     * @return CategoryLayout|null
     */
    public function findOneByCategoryFrontIdAndStoreId(int $categoryId, int $storeId): ?CategoryLayout
    {
        try {
            return $this->createQueryBuilder('cl')
                ->andWhere('cl.categoryId = :categoryId')
                ->andWhere('cl.storeId = :storeId')
                ->setParameter('categoryId', $categoryId)
                ->setParameter('storeId', $storeId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }
}
