<?php

namespace App\Repository\Front;

use App\Entity\Front\Address;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Address|null find($id, $lockMode = null, $lockVersion = null)
 * @method Address|null findOneBy(array $criteria, array $orderBy = null)
 * @method Address[]    findAll()
 * @method Address[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Address[]    findByIds(string $ids)
 * @method void    save(Address $instance)
 * @method void    saveAndFlush(Address $instance)
 * @method void    remove(Address $instance)
 * @method void    removeAndFlush(Address $instance)
 */
class AddressRepository extends EntityFrontRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Address::class);
    }
}
