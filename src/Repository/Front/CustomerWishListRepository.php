<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerWishList;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @method CustomerWishList|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerWishList|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerWishList[]    findAll()
 * @method CustomerWishList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerWishList[]    findByIds(string $ids)
 * @method void    persist(CustomerWishList $instance)
 * @method void    persistAndFlush(CustomerWishList $instance)
 * @method void    remove(CustomerWishList $instance)
 * @method void    removeAndFlush(CustomerWishList $instance)
 */
class CustomerWishListRepository extends FrontRepository
{
    /**
     * CustomerWishListRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, CustomerWishList::class);
    }
}
