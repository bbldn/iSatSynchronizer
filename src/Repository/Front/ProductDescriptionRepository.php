<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductDescription;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method ProductDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductDescription[]    findAll()
 * @method ProductDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductDescription[]    findByIds(string $ids)
 * @method void    persist(ProductDescription $instance)
 * @method void    persistAndFlush(ProductDescription $instance)
 * @method void    remove(ProductDescription $instance)
 * @method void    removeAndFlush(ProductDescription $instance)
 */
class ProductDescriptionRepository extends FrontRepository
{
    /**
     * ProductDescriptionRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductDescription::class);
    }

    /**
     * @param int $productId
     * @param int $languageId
     * @return ProductDescription|null
     */
    public function findOneByProductFrontIdAndLanguageId(int $productId, int $languageId): ?ProductDescription
    {
        try {
            return $this->createQueryBuilder('pd')
                ->andWhere('pd.productId = :productId')
                ->andWhere('pd.languageId = :languageId')
                ->setParameter('productId', $productId)
                ->setParameter('languageId', $languageId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
