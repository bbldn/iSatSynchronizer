<?php

namespace App\Repository\Front;

use App\Entity\Front\Language;
use App\Other\Repository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Language|null find($id, $lockMode = null, $lockVersion = null)
 * @method Language|null findOneBy(array $criteria, array $orderBy = null)
 * @method Language[]    findAll()
 * @method Language[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Language[]    findByIds(string $ids)
 * @method void    persist(Language $instance)
 * @method void    persistAndFlush(Language $instance)
 * @method void    remove(Language $instance)
 * @method void    removeAndFlush(Language $instance)
 */
class LanguageRepository extends FrontRepository
{
    /**
     * LanguageRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Language::class);
    }
}
