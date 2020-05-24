<?php

namespace App\Repository\Front;

use App\Entity\Front\Product;
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
class ProductRepository extends FrontRepository
{
    /** @var ContainerBagInterface $containerBag */
    protected $containerBag;

    /** @var \App\Repository\ProductRepository $productRepository */
    protected $productRepository;

    /**
     * ProductRepository constructor.
     * @param ManagerRegistry $registry
     * @param ContainerBagInterface $containerBag
     * @param \App\Repository\ProductRepository $productRepository
     */
    public function __construct(
        ManagerRegistry $registry,
        ContainerBagInterface $containerBag,
        \App\Repository\ProductRepository $productRepository
    )
    {
        $this->containerBag = $containerBag;
        $this->productRepository = $productRepository;
        parent::__construct($registry, Product::class);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function updatePriceByData(array $data): bool
    {
        $tableNameFront = $this->getClassMetadata()->getTableName();
        $tableName = $this->productRepository->getClassMetadata()->getTableName();
        $dataBase = $this->containerBag->get('database_name');
        $dataBaseFront = $this->containerBag->get('front.database_name');

        $sql = '';
        foreach ($data as $value) {
            $sql .= "
              UPDATE 
                  {$dataBaseFront}.{$tableNameFront} pf 
              INNER JOIN {$dataBase}.{$tableName} p ON pf.product_id = p.front_id 
              SET 
                  pf.price = {$value['price']} 
              WHERE 
                  p.back_id = {$value['product_id']};
            ";
        }

        try {
            $result = $this->getEntityManager()->getConnection()->prepare($sql)->execute();
        } catch (DBALException $e) {
            $result = false;
        }

        return $result;
    }
}
