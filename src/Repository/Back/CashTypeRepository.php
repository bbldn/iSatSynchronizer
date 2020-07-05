<?php

namespace App\Repository\Back;

use App\Entity\Back\CashType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method CashType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CashType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CashType[]    findAll()
 * @method CashType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CashType[]    findByIds(string $ids)
 * @method void    persist(CashType $instance)
 * @method void    persistAndFlush(CashType $instance)
 * @method void    remove(CashType $instance)
 * @method void    removeAndFlush(CashType $instance)
 */
class CashTypeRepository extends BackRepository
{
    /**
     * CashTypeRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, CashType::class);
    }
}
