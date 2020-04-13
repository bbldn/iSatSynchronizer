<?php

namespace App\Repository\Back;

use App\Entity\Back\Currency;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Currency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Currency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Currency[]    findAll()
 * @method Currency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Currency[]    findByIds(string $ids)
 * @method void    save(Currency $instance)
 * @method void    saveAndFlush(Currency $instance)
 * @method void    remove(Currency $instance)
 * @method void    removeAndFlush(Currency $instance)
 */
class CurrencyRepository extends BaseRepository
{
    protected $entityManagerName = 'back';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Currency::class);
    }

    public function findOneByName(string $name): ?Currency
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name = :val')
            ->setParameter('val', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getCurrentCourse()
    {
        $connection = $this->getEntityManager()->getConnection();
        $result = $connection->fetchAll("SELECT `one`.value as 'грн', `two`.value as 'р', 1 as '$' FROM
(SELECT * FROM `SS_currencies` WHERE `shop_id` = 0 AND `name` = 'грн' ORDER BY `id` DESC LIMIT 1) as `one` INNER JOIN
(SELECT * FROM `SS_currencies` WHERE `shop_id` = 0 AND `name` = 'р' ORDER BY `id` DESC LIMIT 1) as `two` ON 1 = 1");
        $result = $result[0];

        return $result;
    }

    // /**
    //  * @return Currencies[] Returns an array of Currencies objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Currencies
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
