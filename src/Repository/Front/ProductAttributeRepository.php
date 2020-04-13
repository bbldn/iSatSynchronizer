<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductAttribute;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductAttribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductAttribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductAttribute[]    findAll()
 * @method ProductAttribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductAttribute[]    findByIds(string $ids)
 * @method void    save(ProductAttribute $instance)
 * @method void    saveAndFlush(ProductAttribute $instance)
 * @method void    remove(ProductAttribute $instance)
 * @method void    removeAndFlush(ProductAttribute $instance)
 */
class ProductAttributeRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductAttribute::class);
    }

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

    public function findOneByAttributeFrontIdAndProductFrontId($attributeId, $productId): ?ProductAttribute
    {
        return $this->createQueryBuilder('par')
            ->andWhere('par.attributeId = :attributeId')
            ->andWhere('par.productId = :productId')
            ->setParameter('attributeId', $attributeId)
            ->setParameter('productId', $productId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
