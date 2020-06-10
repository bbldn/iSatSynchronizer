<?php

namespace App\Repository\Front;

use App\Entity\Front\ReviewAnswer;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ReviewAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReviewAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReviewAnswer[]    findAll()
 * @method ReviewAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReviewAnswerRepository extends FrontRepository
{
    /**
     * ReviewAnswerRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReviewAnswer::class);
    }
}
