<?php

namespace App\Repository\Front;

use App\Entity\Front\Store;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method Store|null find($id, $lockMode = null, $lockVersion = null)
 * @method Store|null findOneBy(array $criteria, array $orderBy = null)
 * @method Store[]    findAll()
 * @method Store[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Store[]    findByIds(string $ids)
 * @method void    persist(Store $instance)
 * @method void    persistAndFlush(Store $instance)
 * @method void    remove(Store $instance)
 * @method void    removeAndFlush(Store $instance)
 */
class StoreRepository extends FrontRepository
{
    /**
     * StoreRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Store::class);
    }
}
