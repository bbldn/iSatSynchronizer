<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerWishList;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerWishList|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerWishList|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerWishList[]    findAll()
 * @method CustomerWishList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerWishList[]    findByIds(string $ids)
 * @method void    save(CustomerWishList $instance)
 * @method void    saveAndFlush(CustomerWishList $instance)
 * @method void    remove(CustomerWishList $instance)
 * @method void    removeAndFlush(CustomerWishList $instance)
 */
class CustomerWishListRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerWishList::class);
    }
}
