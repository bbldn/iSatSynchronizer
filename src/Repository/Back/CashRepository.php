<?php

namespace App\Repository\Back;

use App\Entity\Back\Cash;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cash|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cash|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cash[]    findAll()
 * @method Cash[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Cash[]    findByIds(string $ids)
 * @method void    save(Cash $instance)
 * @method void    saveAndFlush(Cash $instance)
 * @method void    remove(Cash $instance)
 * @method void    removeAndFlush(Cash $instance)
 */
class CashRepository extends EntityBackRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cash::class);
    }
}
