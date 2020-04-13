<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductSpecial;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductSpecial|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductSpecial|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductSpecial[]    findAll()
 * @method ProductSpecial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductSpecial[]    findByIds(string $ids)
 * @method void    save(ProductSpecial $instance)
 * @method void    saveAndFlush(ProductSpecial $instance)
 * @method void    remove(ProductSpecial $instance)
 * @method void    removeAndFlush(ProductSpecial $instance)
 */
class ProductSpecialRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductSpecial::class);
    }
}
