<?php

namespace App\Repository\Back;

use App\Entity\Back\OrderGamePost;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OrderGamePost|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderGamePost|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderGamePost[]    findAll()
 * @method OrderGamePost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderGamePostRepository extends BaseRepository
{
    protected $entityManagerName = 'back';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderGamePost::class);
    }

    public function findOneByOrderNumAndProductBackId(int $orderNum, int $productId): ?OrderGamePost
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.orderNum = :orderNum')
            ->andWhere('o.productId = :productId')
            ->setParameter('orderNum', $orderNum)
            ->setParameter('productId', $productId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param array $ids
     * @return OrderGamePost[] Returns an array of OrderGamePost objects
     */
    public function findWithoutIds(array $ids = [])
    {
        $qb = $this->createQueryBuilder('o');
        return $qb
            ->where($qb->expr()->notIn('o.clientId', $ids))
            ->andWhere('o.documentType = 2')
            ->andWhere('o.id = o.orderNum')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $value
     * @return OrderGamePost[] Returns an array of OrderGamePost objects
     */
    public function findByOrderNum(int $value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.orderNum = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

    public function getTotalPrice(int $orderNum): ?int
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.orderNum = :val')
            ->setParameter('val', $orderNum)
            ->select('SUM(o.price * o.amount) as total')
            ->getQuery()
            ->getSingleScalarResult();
    }

    // /**
    //  * @return OrderGamePost[] Returns an array of OrderGamePost objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderGamePost
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
