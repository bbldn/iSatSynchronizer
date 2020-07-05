<?php

namespace App\Repository\Back;

use App\Entity\Back\OrderGamePost;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Psr\Log\LoggerInterface;

/**
 * @method OrderGamePost|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderGamePost|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderGamePost[]    findAll()
 * @method OrderGamePost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderGamePost[]    findByIds(string $ids)
 * @method void    persist(OrderGamePost $instance)
 * @method void    persistAndFlush(OrderGamePost $instance)
 * @method void    remove(OrderGamePost $instance)
 * @method void    removeAndFlush(OrderGamePost $instance)
 */
class OrderGamePostRepository extends BackRepository
{
    /**
     * OrderGamePostRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, OrderGamePost::class);
    }

    /**
     * @param int $orderNum
     * @param int $productId
     * @return OrderGamePost|null
     */
    public function findOneByOrderNumAndProductBackId(int $orderNum, int $productId): ?OrderGamePost
    {
        try {
            return $this->createQueryBuilder('o')
                ->andWhere('o.orderNum = :orderNum')
                ->andWhere('o.productId = :productId')
                ->setParameter('orderNum', $orderNum)
                ->setParameter('productId', $productId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }

    /**
     * @param array $ids
     * @return OrderGamePost[]
     */
    public function findWithoutIds(array $ids = []): array
    {
        $queryBuilder = $this->createQueryBuilder('o');

        if (count($ids) > 0) {
            $queryBuilder = $queryBuilder->andWhere($queryBuilder->expr()->notIn('o.clientId', $ids));
        }

        return $queryBuilder->andWhere('o.documentType = 2')
            ->andWhere('o.id = o.orderNum')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $value
     * @return OrderGamePost[]
     */
    public function findByOrderNum(int $value): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.orderNum = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $orderNum
     * @return int|null
     */
    public function getTotalPrice(int $orderNum): ?int
    {
        try {
            return $this->createQueryBuilder('o')
                ->andWhere('o.orderNum = :val')
                ->setParameter('val', $orderNum)
                ->select('SUM(o.price * o.amount) as total')
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }
}
