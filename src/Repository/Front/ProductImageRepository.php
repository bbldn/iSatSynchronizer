<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductImage;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method ProductImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductImage[]    findAll()
 * @method ProductImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductImage[]    findByIds(string $ids)
 * @method void    persist(ProductImage $instance)
 * @method void    persistAndFlush(ProductImage $instance)
 * @method void    remove(ProductImage $instance)
 * @method void    removeAndFlush(ProductImage $instance)
 */
class ProductImageRepository extends FrontRepository
{
    /**
     * ProductImageRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductImage::class);
    }

    /**
     * @param int $productId
     * @param string $imagePath
     * @return ProductImage|null
     */
    public function findOneByProductIdAndImagePath(int $productId, string $imagePath): ?ProductImage
    {
        try {
            return $this->createQueryBuilder('c')
                ->andWhere('c.productId = :productId')
                ->setParameter('productId', $productId)
                ->andWhere('c.image = :imagePath')
                ->setParameter('imagePath', $imagePath)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
