<?php

namespace App\Repository\Back;

use App\Entity\Back\Currency;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Currency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Currency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Currency[]    findAll()
 * @method Currency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Currency[]    findByIds(string $ids)
 * @method void    persist(Currency $instance)
 * @method void    persistAndFlush(Currency $instance)
 * @method void    remove(Currency $instance)
 * @method void    removeAndFlush(Currency $instance)
 */
class CurrencyRepository extends EntityBackRepository
{
    /**
     * CurrencyRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Currency::class);
    }

    /**
     * @param string $name
     * @return Currency|null
     */
    public function findOneByName(string $name): ?Currency
    {
        try {
            $result = $this->createQueryBuilder('c')
                ->andWhere('c.name = :val')
                ->setParameter('val', $name)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            $result = null;
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getCurrentCourse()
    {
        $connection = $this->getEntityManager()->getConnection();
        $result = $connection->fetchAll("SELECT `one`.value as 'грн', `two`.value as 'р', 1 as '$' FROM
(SELECT * FROM `SS_currencies` WHERE `shop_id` = 0 AND `name` = 'грн' ORDER BY `id` DESC LIMIT 1) as `one` INNER JOIN
(SELECT * FROM `SS_currencies` WHERE `shop_id` = 0 AND `name` = 'р' ORDER BY `id` DESC LIMIT 1) as `two` ON 1 = 1");

        return $result[0];
    }
}
