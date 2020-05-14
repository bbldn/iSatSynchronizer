<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductAttribute;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

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
     * @return mixed
     */
    public function removeByProductIdAttributeIdLanguageId(int $productId, int $attributeId, int $languageId)
    {
        return $this->createQueryBuilder('par')
            ->andWhere('par.attributeId = :attributeId')
            ->andWhere('par.productId = :productId')
            ->andWhere('par.languageId = :languageId')
            ->setParameter('attributeId', $attributeId)
            ->setParameter('productId', $productId)
            ->setParameter('languageId', $languageId)
            ->delete()
            ->getQuery()
            ->execute();
    }

    /**
     * @param int $attributeId
     * @param int $productId
     * @return ProductAttribute|null
     */
    public function findOneByAttributeFrontIdAndProductFrontId(int $attributeId, int $productId): ?ProductAttribute
    {
        try {
            $result = $this->createQueryBuilder('par')
                ->andWhere('par.attributeId = :attributeId')
                ->andWhere('par.productId = :productId')
                ->setParameter('attributeId', $attributeId)
                ->setParameter('productId', $productId)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $result = null;
        }

        return $result;
    }
}
