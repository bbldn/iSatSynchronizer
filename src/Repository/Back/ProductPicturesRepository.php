<?php

namespace App\Repository\Back;

use App\Entity\Back\ProductPictures;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductPictures|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductPictures|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductPictures[]    findAll()
 * @method ProductPictures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductPictures[]    findByIds(string $ids)
 * @method void    save(ProductPictures $instance)
 * @method void    saveAndFlush(ProductPictures $instance)
 * @method void    remove(ProductPictures $instance)
 * @method void    removeAndFlush(ProductPictures $instance)
 */
class ProductPicturesRepository extends EntityBackRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductPictures::class);
    }

    /**
     * @param int $value
     * @return ProductPictures[] Returns an array of ProductPictures objects
     */
    public function findByProductBackId(int $value)
    {
        return $this->createQueryBuilder('pp')
            ->andWhere('pp.productId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }
}
