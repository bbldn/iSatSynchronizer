<?php

namespace App\Repository\Front;

use App\Entity\Front\Product;
use App\Other\BaseRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Product[]    findByIds(string $ids)
 * @method void    save(Product $instance)
 * @method void    saveAndFlush(Product $instance)
 * @method void    remove(Product $instance)
 * @method void    removeAndFlush(Product $instance)
 */
class ProductRepository extends BaseRepository
{
    protected $entityManagerName = 'front';
    protected $containerBag;

    public function __construct(ManagerRegistry $registry, ContainerBagInterface $containerBag)
    {
        $this->containerBag = $containerBag;
        parent::__construct($registry, Product::class);
    }

    public function updateProductsPrice(): bool
    {
        $frontDatabaseName = $this->containerBag->get('front.database_name');
        $databaseName = $this->containerBag->get('database_name');
        $backDatabaseName = $this->containerBag->get('back.database_name');

        $sql = "UPDATE `{$frontDatabaseName}`.`oc_product` oc 
                INNER JOIN `{$databaseName}`.`products` as isp ON isp.`front_id` =  oc.`product_id`
                INNER JOIN `{$backDatabaseName}`.`SS_products` as inp ON isp.`back_id` =  inp.`productID`
                SET oc.`price` = inp.price;";

        return $this->getEntityManager()->getConnection()->prepare($sql)->execute();
    }

    public function updateProductsPriceByIds(string $ids): bool
    {
        $frontDatabaseName = $this->containerBag->get('front.database_name');
        $databaseName = $this->containerBag->get('database_name');
        $backDatabaseName = $this->containerBag->get('back.database_name');

        $sql = "UPDATE `{$frontDatabaseName}`.`oc_product` oc 
                INNER JOIN `{$databaseName}`.`products` as isp ON isp.`front_id` =  oc.`product_id`
                INNER JOIN `{$backDatabaseName}`.`SS_products` as inp ON isp.`back_id` =  inp.`productID`
                SET oc.`price` = inp.price WHERE inp.`productID` IN ({$ids});";

        return $this->getEntityManager()->getConnection()->prepare($sql)->execute();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
