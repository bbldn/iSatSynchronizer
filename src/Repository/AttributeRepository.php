<?php

namespace App\Repository;

use App\Entity\Attribute;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method Attribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attribute[]    findAll()
 * @method Attribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Attribute[]    findByIds(string $ids)
 * @method void    persist(Attribute $instance)
 * @method void    persistAndFlush(Attribute $instance)
 * @method void    remove(Attribute $instance)
 * @method void    removeAndFlush(Attribute $instance)
 * @method Attribute|null findOneByBackId(int $value)
 * @method Attribute|null findOneByFrontId(int $value)
 */
class AttributeRepository extends EntityRepository
{
    /**
     * AttributeRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Attribute::class);
    }
}
