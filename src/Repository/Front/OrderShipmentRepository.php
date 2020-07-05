<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderShipment;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method OrderShipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderShipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderShipment[]    findAll()
 * @method OrderShipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderShipment[]    findByIds(string $ids)
 * @method void    persist(OrderShipment $instance)
 * @method void    persistAndFlush(OrderShipment $instance)
 * @method void    remove(OrderShipment $instance)
 * @method void    removeAndFlush(OrderShipment $instance)
 */
class OrderShipmentRepository extends FrontRepository
{
    /**
     * OrderShipmentRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, OrderShipment::class);
    }
}
