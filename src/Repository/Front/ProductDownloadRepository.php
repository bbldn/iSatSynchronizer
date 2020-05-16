<?php

namespace App\Repository\Front;

use App\Entity\Front\ProductDownload;
use App\Helper\Repository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductDownload|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductDownload|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductDownload[]    findAll()
 * @method ProductDownload[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method ProductDownload[]    findByIds(string $ids)
 * @method void    persist(ProductDownload $instance)
 * @method void    persistAndFlush(ProductDownload $instance)
 * @method void    remove(ProductDownload $instance)
 * @method void    removeAndFlush(ProductDownload $instance)
 */
class ProductDownloadRepository extends FrontRepository
{
    /**
     * ProductDownloadRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductDownload::class);
    }
}
