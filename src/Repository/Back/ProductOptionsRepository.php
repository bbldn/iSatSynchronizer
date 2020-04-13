<?php

namespace App\Repository\Back;

use App\Entity\Back\ProductOptions;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductOptions|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductOptions|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductOptions[]    findAll()
 * @method ProductOptions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductOptions[]    findByIds(string $ids)
 * @method void    save(ProductOptions $instance)
 * @method void    saveAndFlush(ProductOptions $instance)
 * @method void    remove(ProductOptions $instance)
 * @method void    removeAndFlush(ProductOptions $instance)
 */
class ProductOptionsRepository extends EntityBackRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductOptions::class);
    }
}
