<?php

namespace App\Repository\Front;

use App\Entity\Front\CustomerApproval;
use App\Other\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CustomerApproval|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerApproval|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerApproval[]    findAll()
 * @method CustomerApproval[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method CustomerApproval[]    findByIds(string $ids)
 * @method void    save(CustomerApproval $instance)
 * @method void    saveAndFlush(CustomerApproval $instance)
 * @method void    remove(CustomerApproval $instance)
 * @method void    removeAndFlush(CustomerApproval $instance)
 */
class CustomerApprovalRepository extends EntityRepository
{
    protected $entityManagerName = 'front';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerApproval::class);
    }

    // /**
    //  * @return CustomerApproval[] Returns an array of CustomerApproval objects
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
    public function findOneBySomeField($value): ?CustomerApproval
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
