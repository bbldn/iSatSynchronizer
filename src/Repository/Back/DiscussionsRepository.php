<?php

namespace App\Repository\Back;

use App\Entity\Back\Discussions;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

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
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Discussions::class);
    }
}
