<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductAttribute;
use App\Helper\ExceptionFormatter;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;

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
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, ProductAttribute::class);
    }

    /**
     * @param int $productId
     * @param int $attributeId
     * @param int $languageId
     * @return ProductAttribute|null
     */
    public function findOneByProductIdAttributeIdLanguageId(
        int $productId,
        int $attributeId,
        int $languageId
    ): ?ProductAttribute
    {
        try {
            return $this->createQueryBuilder('par')
                ->andWhere('par.productId = :productId')
                ->andWhere('par.attributeId = :attributeId')
                ->andWhere('par.languageId = :languageId')
                ->setParameter('productId', $productId)
                ->setParameter('attributeId', $attributeId)
                ->setParameter('languageId', $languageId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $this->logger->error(ExceptionFormatter::e($e));

            return null;
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
            $this->logger->error(ExceptionFormatter::e($e));

            return null;
        }
    }
}
