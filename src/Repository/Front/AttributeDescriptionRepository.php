<?php

namespace App\Repository\Front;

use App\Entity\Front\AttributeDescription;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method AttributeDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributeDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributeDescription[]    findAll()
 * @method AttributeDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method AttributeDescription[]    findByIds(string $ids)
 * @method void    persist(AttributeDescription $instance)
 * @method void    persistAndFlush(AttributeDescription $instance)
 * @method void    remove(AttributeDescription $instance)
 * @method void    removeAndFlush(AttributeDescription $instance)
 */
class AttributeDescriptionRepository extends FrontRepository
{
    /**
     * AttributeDescriptionRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeDescription::class);
    }

    /**
     * @param int $attributeId
     * @param int $languageId
     * @return AttributeDescription|null
     */
    public function findOneByAttributeIdAndLanguageId(int $attributeId, int $languageId): ?AttributeDescription
    {
        try {
            return $this->createQueryBuilder('ad')
                ->andWhere('ad.attributeId = :attributeId')
                ->setParameter('attributeId', $attributeId)
                ->andWhere('ad.languageId = :languageId')
                ->setParameter('languageId', $languageId)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param string $value
     * @return AttributeDescription|null
     */
    public function findOneByName(string $value): ?AttributeDescription
    {
        try {
            return $this->createQueryBuilder('a')
                ->andWhere('a.name = :val')
                ->setParameter('val', $value)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
