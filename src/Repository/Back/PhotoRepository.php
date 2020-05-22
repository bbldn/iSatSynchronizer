<?php

namespace App\Repository\Back;

use App\Entity\Back\Photo;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Photo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Photo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Photo[]    findAll()
 * @method Photo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Photo[]    findByIds(string $ids)
 * @method void    persist(Photo $instance)
 * @method void    persistAndFlush(Photo $instance)
 * @method void    remove(Photo $instance)
 * @method void    removeAndFlush(Photo $instance)
 */
class PhotoRepository extends BackRepository
{
    /**
     * PhotoRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Photo::class);
    }

    /**
     * @param int $value
     * @return Photo[]
     */
    public function findByProductBackId(int $value): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.productId = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }
}
