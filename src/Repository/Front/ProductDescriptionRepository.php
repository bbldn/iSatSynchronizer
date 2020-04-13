<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductDescription;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductDescription[]    findAll()
 * @method ProductDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductDescription[]    findByIds(string $ids)
 * @method void    save(ProductDescription $instance)
 * @method void    saveAndFlush(ProductDescription $instance)
 * @method void    remove(ProductDescription $instance)
 * @method void    removeAndFlush(ProductDescription $instance)
 */
class ProductDescriptionRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductDescription::class);
    }
}
