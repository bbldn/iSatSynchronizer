<?php

namespace App\Repository\Front;

use App\Entity\Front\Review;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method Review|null find($id, $lockMode = null, $lockVersion = null)
 * @method Review|null findOneBy(array $criteria, array $orderBy = null)
 * @method Review[]    findAll()
 * @method Review[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Review[]    findByIds(string $ids)
 * @method void    persist(Review $instance)
 * @method void    persistAndFlush(Review $instance)
 * @method void    remove(Review $instance)
 * @method void    removeAndFlush(Review $instance)
 */
class ReviewRepository extends FrontRepository
{
    /**
     * ReviewRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Review::class);
    }
}
