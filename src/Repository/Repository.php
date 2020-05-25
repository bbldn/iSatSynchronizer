<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\Mapping\MappingException;
use Doctrine\Persistence\ManagerRegistry;

abstract class Repository extends ServiceEntityRepository
{
    /** @var string $entityManagerName */
    protected $entityManagerName = 'default';

    /** @var string $tableName */
    protected $tableName = 'default';

    /**
     * EntityRepository constructor.
     * @param ManagerRegistry $registry
     * @param string $entityClass
     */
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
    public function persist(object $object)
    {
        $this->_em->persist($object);
    }

    /**
     * @param object $instance
     */
    public function persistAndFlush(object $instance)
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
     * @return bool
     */
    public function resetAutoIncrements(): bool
    {
        $sql = "ALTER TABLE `{$this->tableName}` AUTO_INCREMENT = 1";

        try {
            return $this->getEntityManager()->getConnection()->prepare($sql)->execute();
        } catch (DBALException $e) {
            return false;
        }
    }

    /**
     * @param string $ids
     * @return array
     */
    public function findByIds(string $ids): array
    {
        try {
            $identifier = $this->getClassMetadata()->getSingleIdentifierFieldName();
        } catch (MappingException $e) {
            return [];
        }

        return $this->createQueryBuilder('c')
            ->where("c.{$identifier} IN(:ids)")
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return bool
     */
    public function tableExists(): bool
    {
        $connection = $this->getEntityManager()->getConnection();

        $database = $connection->getDatabase();
        $queryBuilder = $connection->createQueryBuilder();
        $queryBuilder->select('count(*)');
        $queryBuilder->from('information_schema.tables', 't');
        $queryBuilder->andWhere("table_name = '{$this->tableName}'");
        $queryBuilder->andWhere("table_schema = '{$database}'");
        $queryBuilder->setMaxResults(1);

        try {
            $query = $connection->prepare($queryBuilder->getSQL());

            return $query->execute() > 0;
        } catch (DBALException $e) {
            return false;
        }
    }
}