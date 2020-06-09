<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductAttribute;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * @method ProductAttribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductAttribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductAttribute[]    findAll()
 * @method ProductAttribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductAttribute[]    findByIds(string $ids)
 * @method void    persist(ProductAttribute $instance)
 * @method void    persistAndFlush(ProductAttribute $instance)
 * @method void    remove(ProductAttribute $instance)
 * @method void    removeAndFlush(ProductAttribute $instance)
 */
class ProductAttributeRepository extends FrontRepository
{
    /**
     * ProductAttributeRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductAttribute::class);
    }

    /**
     * @param int $productId
     * @param int $attributeId
     * @param int $languageId
     * @param string $text
     * @return bool
     */
    public function existsByProductIdAttributeIdLanguageIdText(
        int $productId,
        int $attributeId,
        int $languageId,
        string $text
    ): bool
    {
        try {
            return $this->createQueryBuilder('par')
                    ->select('count(par.productId)')
                    ->andWhere('par.productId = :productId')
                    ->andWhere('par.attributeId = :attributeId')
                    ->andWhere('par.languageId = :languageId')
                    ->andWhere('par.text = :text')
                    ->setParameter('productId', $productId)
                    ->setParameter('attributeId', $attributeId)
                    ->setParameter('languageId', $languageId)
                    ->setParameter('text', $text)
                    ->getQuery()
                    ->getSingleScalarResult() > 0;
        } catch (NonUniqueResultException $e) {
            return false;
        } catch (NoResultException $e) {
            return false;
        }
    }

    /**
     * @param int $attributeId
     * @param int $productId
     * @return ProductAttribute|null
     */
    public function findOneByAttributeFrontIdAndProductFrontId(int $attributeId, int $productId): ?ProductAttribute
    {
        try {
            return $this->createQueryBuilder('par')
                ->andWhere('par.attributeId = :attributeId')
                ->andWhere('par.productId = :productId')
                ->setParameter('attributeId', $attributeId)
                ->setParameter('productId', $productId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
