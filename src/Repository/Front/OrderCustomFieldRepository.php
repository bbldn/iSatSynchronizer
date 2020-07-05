<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderCustomField;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method OrderCustomField|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderCustomField|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderCustomField[]    findAll()
 * @method OrderCustomField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderCustomField[]    findByIds(string $ids)
 * @method void    persist(OrderCustomField $instance)
 * @method void    persistAndFlush(OrderCustomField $instance)
 * @method void    remove(OrderCustomField $instance)
 * @method void    removeAndFlush(OrderCustomField $instance)
 */
class OrderCustomFieldRepository extends FrontRepository
{
    /**
     * OrderCustomFieldRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, OrderCustomField::class);
    }
}
