<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGroupsExtra;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuyersGroupsExtra|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGroupsExtra|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGroupsExtra[]    findAll()
 * @method BuyersGroupsExtra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method BuyersGroupsExtra[]    findByIds(string $ids)
 * @method void    save(BuyersGroupsExtra $instance)
 * @method void    saveAndFlush(BuyersGroupsExtra $instance)
 * @method void    remove(BuyersGroupsExtra $instance)
 * @method void    removeAndFlush(BuyersGroupsExtra $instance)
 */
class BuyersGroupsExtraRepository extends EntityBackRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuyersGroupsExtra::class);
    }
}
