<?php

namespace App\Repository\Back;

use App\Entity\Back\BuyersGamePost;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method BuyersGamePost|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuyersGamePost|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuyersGamePost[]    findAll()
 * @method BuyersGamePost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method BuyersGamePost[]    findByIds(string $ids)
 * @method void    persist(BuyersGamePost $instance)
 * @method void    persistAndFlush(BuyersGamePost $instance)
 * @method void    remove(BuyersGamePost $instance)
 * @method void    removeAndFlush(BuyersGamePost $instance)
 */
class BuyersGamePostRepository extends BackRepository
{
    /**
     * BuyersGamePostRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuyersGamePost::class);
    }

    /**
     * @param $value
     * @return BuyersGamePost|null
     */
    public function findOneByTelephone($value): ?BuyersGamePost
    {
        try {
            return $this->createQueryBuilder('bgp')
                ->andWhere('bgp.phone = :val')
                ->setParameter('val', $value)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param int $customerId
     * @return float
     */
    public function getBalanceByCustomerId(int $customerId): float
    {
        $connection = $this->getEntityManager()->getConnection();
        $sql = "
            SELECT 
                (IFNULL(cash.`income`, 0) - IFNULL(SUM(orders.`price` * orders.`amount`), 0)) as `balance` 
            FROM 
                SS_orders_gamepost orders 
            LEFT JOIN 
                (
                    SELECT 
                        SUM(`price` / `currency_value`) as `income`, `order_num` 
                    FROM 
                        SS_cash 
                    GROUP BY 
                        `order_num`
                ) cash 
            ON 
                cash.`order_num` = orders.`order_num`
            WHERE 
                orders.`status` != 9 AND orders.`client_id` = {$customerId} 
            GROUP BY 
                cash.`income`;";
        $result = $connection->fetchAll($sql);

        return $result[0]['balance'];
    }
}
