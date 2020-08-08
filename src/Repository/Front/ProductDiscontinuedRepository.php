<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductDiscontinued;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\UnexpectedResultException;
use Psr\Log\LoggerInterface;

/**
 * @method ProductDiscontinued|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductDiscontinued|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductDiscontinued[]    findAll()
 * @method ProductDiscontinued[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductDiscontinuedRepository extends FrontRepository
{
    /**
     * ProductDiscontinuedRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, ProductDiscontinued::class);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function exists(int $id): bool
    {
        try {
            return $this->createQueryBuilder('pd')
                    ->select('count(pd.productId)')
                    ->andWhere('pd.productId = :val')
                    ->setParameter('val', $id)
                    ->getQuery()
                    ->getSingleScalarResult() > 0;
        } catch (UnexpectedResultException $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return false;
        }
    }

    /**
     * @param int $id
     */
    public function removeById(int $id): void
    {
        $this->createQueryBuilder('pd')
            ->andWhere('pd.productId = :val')
            ->setParameter('val', $id)
            ->delete()
            ->getQuery()
            ->execute();
    }
}
