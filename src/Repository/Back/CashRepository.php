<?php

namespace App\Repository\Back;

use App\Entity\Back\Cash;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method Cash|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cash|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cash[]    findAll()
 * @method Cash[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Cash[]    findByIds(string $ids)
 * @method void    persist(Cash $instance)
 * @method void    persistAndFlush(Cash $instance)
 * @method void    remove(Cash $instance)
 * @method void    removeAndFlush(Cash $instance)
 */
class CashRepository extends BackRepository
{
    /**
     * CashRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Cash::class);
    }
}
