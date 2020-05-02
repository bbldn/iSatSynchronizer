<?php

namespace App\Repository\Front;

use App\Entity\Front\Product;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Product[]    findByIds(string $ids)
 * @method void    persist(Product $instance)
 * @method void    persistAndFlush(Product $instance)
 * @method void    remove(Product $instance)
 * @method void    removeAndFlush(Product $instance)
 */
class ProductRepository extends EntityFrontRepository
{
    /** @var ContainerBagInterface $containerBag */
    protected $containerBag;

    /**
     * ProductRepository constructor.
     * @param ManagerRegistry $registry
     * @param ContainerBagInterface $containerBag
     */
    public function __construct(ManagerRegistry $registry, ContainerBagInterface $containerBag)
    {
        $this->containerBag = $containerBag;
        parent::__construct($registry, Product::class);
    }

    /**
     * @return bool
     */
    public function updateProductsPrice(): bool
    {
        $frontDatabaseName = $this->containerBag->get('front.database_name');
        $databaseName = $this->containerBag->get('database_name');
        $backDatabaseName = $this->containerBag->get('back.database_name');

        $sql = "UPDATE `{$frontDatabaseName}`.`oc_product` oc 
                INNER JOIN `{$databaseName}`.`products` as isp ON isp.`front_id` =  oc.`product_id`
                INNER JOIN `{$backDatabaseName}`.`SS_products` as inp ON isp.`back_id` =  inp.`productID`
                SET oc.`price` = inp.price;";

        try {
            $result = $this->getEntityManager()->getConnection()->prepare($sql)->execute();
        } catch (DBALException $e) {
            //@TODO Notify
            $result = false;
        }

        return $result;
    }

    /**
     * @param string $ids
     * @return bool
     */
    public function updateProductsPriceByIds(string $ids): bool
    {
        $frontDatabaseName = $this->containerBag->get('front.database_name');
        $databaseName = $this->containerBag->get('database_name');
        $backDatabaseName = $this->containerBag->get('back.database_name');

        $sql = "UPDATE `{$frontDatabaseName}`.`oc_product` oc 
                INNER JOIN `{$databaseName}`.`products` as isp ON isp.`front_id` =  oc.`product_id`
                INNER JOIN `{$backDatabaseName}`.`SS_products` as inp ON isp.`back_id` =  inp.`productID`
                SET oc.`price` = inp.price WHERE inp.`productID` IN ({$ids});";

        try {
            $result = $this->getEntityManager()->getConnection()->prepare($sql)->execute();
        } catch (DBALException $e) {
            //@TODO
            $result = false;
        }

        return $result;
    }

    /**
     * @param string $ids
     * @return bool
     */
    public function updateProductsPriceByCategoryIds(string $ids): bool
    {
        $frontDatabaseName = $this->containerBag->get('front.database_name');
        $databaseName = $this->containerBag->get('database_name');
        $backDatabaseName = $this->containerBag->get('back.database_name');

        $sql = "UPDATE `{$frontDatabaseName}`.`oc_product` oc 
                INNER JOIN `{$databaseName}`.`products` as isp ON isp.`front_id` =  oc.`product_id`
                INNER JOIN `{$backDatabaseName}`.`SS_products` as inp ON isp.`back_id` =  inp.`productID`
                SET oc.`price` = inp.price WHERE inp.`categoryID` IN ({$ids});";

        try {
            $result = $this->getEntityManager()->getConnection()->prepare($sql)->execute();
        } catch (DBALException $e) {
            $result = false;
        }

        return $result;
    }
}
