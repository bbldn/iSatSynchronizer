<?php

namespace App\Repository\Front;

use App\Entity\Front\Review;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Review|null find($id, $lockMode = null, $lockVersion = null)
 * @method Review|null findOneBy(array $criteria, array $orderBy = null)
 * @method Review[]    findAll()
 * @method Review[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Review[]    findByIds(string $ids)
 * @method void    save(Review $instance)
 * @method void    saveAndFlush(Review $instance)
 * @method void    remove(Review $instance)
 * @method void    removeAndFlush(Review $instance)
 */
class ReviewRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }
}
