<?php

namespace App\Repository\Front;

use App\Entity\Front\CategoryStore;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

/**
 * @method CategoryStore|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryStore|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryStore[]    findAll()
 * @method CategoryStore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CategoryStore[]    findByIds(string $ids)
 * @method void    persist(CategoryStore $instance)
 * @method void    persistAndFlush(CategoryStore $instance)
 * @method void    remove(CategoryStore $instance)
 * @method void    removeAndFlush(CategoryStore $instance)
 */
class CategoryStoreRepository extends FrontRepository
{
    /**
     * CategoryStoreRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, CategoryStore::class);
    }

    /**
     * @param int $categoryId
     * @param int $storeId
     * @return CategoryStore|null
     */
    public function findOneByCategoryFrontIdAndStoreId(int $categoryId, int $storeId): ?CategoryStore
    {
        try {
            return $this->createQueryBuilder('cs')
                ->andWhere('cs.categoryId = :categoryId')
                ->andWhere('cs.storeId = :storeId')
                ->setParameter('categoryId', $categoryId)
                ->setParameter('storeId', $storeId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return null;
        }
    }
}
