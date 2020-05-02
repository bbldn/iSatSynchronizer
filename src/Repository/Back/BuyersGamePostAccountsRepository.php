<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGamePostAccounts;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuyersGamePostAccounts|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGamePostAccounts|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGamePostAccounts[]    findAll()
 * @method BuyersGamePostAccounts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method BuyersGamePostAccounts[]    findByIds(string $ids)
 * @method void    persist(BuyersGamePostAccounts $instance)
 * @method void    persistAndFlush(BuyersGamePostAccounts $instance)
 * @method void    remove(BuyersGamePostAccounts $instance)
 * @method void    removeAndFlush(BuyersGamePostAccounts $instance)
 */
class BuyersGamePostAccountsRepository extends EntityBackRepository
{
    /**
     * BuyersGamePostAccountsRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuyersGamePostAccounts::class);
    }
}
