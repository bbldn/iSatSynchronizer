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

        $sql = '';
        foreach ($data as $value) {
            $queryBuilder = $this->getEntityManager()->getConnection()->createQueryBuilder();
            $queryBuilder->innerJoin('pb', $tableName, 'p', 'pb.product_id = p.front_id');
            $queryBuilder->set('pb.price', $value['price']);
            $queryBuilder->where("pb.`product_id` = {$value['product_id']}");
            $queryBuilder->update($tableNameFront, 'pb');

            $sql .= $queryBuilder->getSQL() . ';';
        }

        try {
            $result = $this->getEntityManager()->getConnection()->prepare($sql)->execute();
        } catch (DBALException $e) {
            $result = false;
        }

        return $result;
    }
}
