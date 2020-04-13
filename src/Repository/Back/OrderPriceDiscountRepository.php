<?php

namespace App\Repository\Back;

use App\Entity\Back\OrderPriceDiscount;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderPriceDiscount|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderPriceDiscount|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderPriceDiscount[]    findAll()
 * @method OrderPriceDiscount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderPriceDiscount[]    findByIds(string $ids)
 * @method void    save(OrderPriceDiscount $instance)
 * @method void    saveAndFlush(OrderPriceDiscount $instance)
 * @method void    remove(OrderPriceDiscount $instance)
 * @method void    removeAndFlush(OrderPriceDiscount $instance)
 */
class OrderPriceDiscountRepository extends EntityBackRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderPriceDiscount::class);
    }
}
