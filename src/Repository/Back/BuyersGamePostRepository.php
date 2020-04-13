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
 * @method void    save(BuyersGamePost $instance)
 * @method void    saveAndFlush(BuyersGamePost $instance)
 * @method void    remove(BuyersGamePost $instance)
 * @method void    removeAndFlush(BuyersGamePost $instance)
 */
class BuyersGamePostRepository extends EntityBackRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuyersGamePost::class);
    }

    public function findOneByTelephone($value): ?BuyersGamePost
    {
        return $this->createQueryBuilder('bgp')
            ->andWhere('bgp.phone = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
