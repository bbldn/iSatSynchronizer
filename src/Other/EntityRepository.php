<?php

namespace App\Other;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EntityRepository extends ServiceEntityRepository
{
    protected $entityManagerName = 'default';
    protected $tableName = 'default';

    public function __construct(ManagerRegistry $registry, $entityClass = '')
    {
        parent::__construct($registry, $entityClass);
        $this->_em = $registry->getManager($this->entityManagerName);
        $this->tableName = $this->getEntityManager()->getClassMetadata($this->getEntityName())->getTableName();
    }

    /**
     *
     */
    public function flush()
    {
        $this->_em->flush();
    }

    /**
     * @param object $object
     */
    public function save(object $object)
    {
        $this->_em->persist($object);
    }

    /**
     * @param object $instance
     */
    public function saveAndFlush(object $instance)
    {
        $this->_em->persist($instance);
        $this->_em->flush();
    }

    /**
     * @param object $object
     */
    public function remove(object $object)
    {
        $this->_em->remove($object);
    }

    /**
     * @param object $object
     */
    public function removeAndFlush(object $object)
    {
        $this->_em->remove($object);
        $this->_em->flush();
    }

    /**
     * @return mixed
     */
    public function removeAll()
    {
        return $this->createQueryBuilder('c')->delete()->getQuery()->execute();
    }

    /**
     * @param string $ids
     * @return null|object
     */
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