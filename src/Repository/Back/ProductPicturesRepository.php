<?php

namespace App\Repository\Back;

use App\Entity\Back\ProductPictures;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method ProductPictures|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductPictures|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductPictures[]    findAll()
 * @method ProductPictures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductPictures[]    findByIds(string $ids)
 * @method void    persist(ProductPictures $instance)
 * @method void    persistAndFlush(ProductPictures $instance)
 * @method void    remove(ProductPictures $instance)
 * @method void    removeAndFlush(ProductPictures $instance)
 */
class ProductPicturesRepository extends BackRepository
{
    /**
     * ProductPicturesRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, ProductPictures::class);
    }

    /**
     * @param int $value
     * @return ProductPictures[]
     */
    public function findByProductBackId(int $value): array
    {
        return $this->createQueryBuilder('pp')
            ->andWhere('pp.productId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }
}
