<?php

namespace App\Repository\Front;

use App\Entity\Front\Language;
use Doctrine\Common\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

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
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry)
    {
        parent::__construct($logger, $registry, Language::class);
    }
}
