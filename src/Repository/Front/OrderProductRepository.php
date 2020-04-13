<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderProduct;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderProduct[]    findAll()
 * @method OrderProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderProduct[]    findByIds(string $ids)
 * @method void    save(OrderProduct $instance)
 * @method void    saveAndFlush(OrderProduct $instance)
 * @method void    remove(OrderProduct $instance)
 * @method void    removeAndFlush(OrderProduct $instance)
 */
class OrderProductRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderProduct::class);
    }

    /**
     * @param int $value
     * @return OrderProduct[] Returns an array of OrderProduct objects
     */
    public function findByOrderFrontId(int $value)
    {
        return $this->createQueryBuilder('op')
            ->andWhere('op.orderId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }
}
