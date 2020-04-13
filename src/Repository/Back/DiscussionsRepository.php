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
 * @method void    save(Discussions $instance)
 * @method void    saveAndFlush(Discussions $instance)
 * @method void    remove(Discussions $instance)
 * @method void    removeAndFlush(Discussions $instance)
 */
class DiscussionsRepository extends EntityBackRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Discussions::class);
    }
}
