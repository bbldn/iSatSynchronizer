<?php

namespace App\Repository\Front;

use App\Entity\Front\Product;
use App\Repository\ProductRepository as ProductRepositoryMain;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;

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
    /** @var ProductRepository $productRepository */
    protected $productRepository;

    /** @var string $dataBaseName */
    protected $dataBaseName;

    /** @var string $dataBaseNameFront */
    protected $dataBaseNameFront;

    /**
     * ProductRepository constructor.
     * @param ManagerRegistry $registry
     * @param ProductRepositoryMain $productRepository
     * @param string $dataBaseName
     * @param string $dataBaseNameFront
     */
    public function __construct(
        ManagerRegistry $registry,
        ProductRepositoryMain $productRepository,
        string $dataBaseName,
        string $dataBaseNameFront
    )
    {
        $this->productRepository = $productRepository;
        $this->dataBaseName = $dataBaseName;
        $this->dataBaseNameFront = $dataBaseNameFront;
        parent::__construct($registry, Product::class);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function updatePriceByData(array $data): bool
    {
        $tableName = $this->productRepository->getClassMetadata()->getTableName();
        $tableNameFront = $this->getClassMetadata()->getTableName();

        $sql = '';
        foreach ($data as $value) {
            $sql .= "
              UPDATE 
                  {$this->dataBaseNameFront}.{$tableNameFront} pf 
              INNER JOIN {$this->dataBaseName}.{$tableName} p ON pf.product_id = p.front_id 
              SET 
                  pf.price = {$value['price']} 
              WHERE 
                  p.back_id = {$value['productId']};
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
