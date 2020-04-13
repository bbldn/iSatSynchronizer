<?php

namespace App\Other;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BaseRepository extends ServiceEntityRepository
{
    protected $entityManagerName = 'default';
    protected $tableName = 'default';

    public function __construct(ManagerRegistry $registry, $entityClass = '')
    {
        parent::__construct($registry, $entityClass);
        $this->_em = $registry->getManager($this->entityManagerName);
        $this->tableName = $this->getEntityManager()->getClassMetadata($this->getEntityName())->getTableName();
    }

    public function flush()
    {
        $this->_em->flush();
    }

    public function save(object $object)
    {
        $this->_em->persist($object);
    }

    public function saveAndFlush(object $object)
    {
        $this->_em->persist($object);
        $this->_em->flush();
    }

    public function remove(object $object)
    {
        $this->_em->remove($object);
    }

    public function removeAndFlush(object $object)
    {
        $this->_em->remove($object);
        $this->_em->flush();
    }

    public function removeAll()
    {
        return $this->createQueryBuilder('c')->delete()->getQuery()->execute();
    }

    public function findByIds(string $ids): ?object
    {
        return $this->createQueryBuilder('c')
            ->where("c.id IN(:ids)")
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();
    }

    public function resetAutoIncrements()
    {
        $sql = "ALTER TABLE `{$this->tableName}` AUTO_INCREMENT = 1";

        return $this->getEntityManager()->getConnection()->prepare($sql)->execute();
    }
}