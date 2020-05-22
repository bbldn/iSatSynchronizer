<?php

namespace App\Repository\Front;

use App\Entity\Front\OrderVoucher;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderVoucher|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderVoucher|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderVoucher[]    findAll()
 * @method OrderVoucher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method OrderVoucher[]    findByIds(string $ids)
 * @method void    persist(OrderVoucher $instance)
 * @method void    persistAndFlush(OrderVoucher $instance)
 * @method void    remove(OrderVoucher $instance)
 * @method void    removeAndFlush(OrderVoucher $instance)
 */
class OrderVoucherRepository extends FrontRepository
{
    /**
     * OrderVoucherRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderVoucher::class);
    }
}
