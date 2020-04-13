<?php

namespace App\Repository\Front;

use App\Entity\Front\AttributeDescription;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AttributeDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributeDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributeDescription[]    findAll()
 * @method AttributeDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method AttributeDescription[]    findByIds(string $ids)
 * @method void    save(AttributeDescription $instance)
 * @method void    saveAndFlush(AttributeDescription $instance)
 * @method void    remove(AttributeDescription $instance)
 * @method void    removeAndFlush(AttributeDescription $instance)
 */
class AttributeDescriptionRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeDescription::class);
    }

    public function findByName($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.name = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
