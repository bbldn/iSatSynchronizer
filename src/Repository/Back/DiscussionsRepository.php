<?php

namespace App\Repository\Back;

use App\Entity\Back\Discussions;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Discussions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Discussions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Discussions[]    findAll()
 * @method Discussions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Discussions[]    findByIds(string $ids)
 * @method void    persist(Discussions $instance)
 * @method void    persistAndFlush(Discussions $instance)
 * @method void    remove(Discussions $instance)
 * @method void    removeAndFlush(Discussions $instance)
 */
class DiscussionsRepository extends BackRepository
{
    /**
     * DiscussionsRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Discussions::class);
    }
}
