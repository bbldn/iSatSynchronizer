<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGamePost;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuyersGamePost|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGamePost|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGamePost[]    findAll()
 * @method BuyersGamePost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method BuyersGamePost[]    findByIds(string $ids)
 * @method void    persist(BuyersGamePost $instance)
 * @method void    persistAndFlush(BuyersGamePost $instance)
 * @method void    remove(BuyersGamePost $instance)
 * @method void    removeAndFlush(BuyersGamePost $instance)
 */
class BuyersGamePostRepository extends BackRepository
{
    /**
     * BuyersGamePostRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuyersGamePost::class);
    }

    /**
     * @param $value
     * @return BuyersGamePost|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByTelephone($value): ?BuyersGamePost
    {
        return $this->createQueryBuilder('bgp')
            ->andWhere('bgp.phone = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
