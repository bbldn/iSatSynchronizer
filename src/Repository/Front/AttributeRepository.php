<?php

namespace App\Repository\Front;

use App\Entity\Front\Attribute;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Attribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attribute[]    findAll()
 * @method Attribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Attribute[]    findByIds(string $ids)
 * @method void    save(Attribute $instance)
 * @method void    saveAndFlush(Attribute $instance)
 * @method void    remove(Attribute $instance)
 * @method void    removeAndFlush(Attribute $instance)
 */
class AttributeRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attribute::class);
    }

    public function checkExistsById(?int $id)
    {
        if (null === $id) {
            return false;
        }

        return $this->createQueryBuilder('c')
                ->select('count(c.attribute_id)')
                ->andWhere('c.attribute_id = :val')
                ->setParameter('val', $id)
                ->getQuery()
                ->getScalarResult() > 0;
    }
}
