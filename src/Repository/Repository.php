<?php

namespace App\Repository;

use App\Helper\ExceptionFormatter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\Mapping\MappingException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

abstract class Repository extends ServiceEntityRepository
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var string $entityManagerName */
    protected $entityManagerName = 'default';

    /** @var string $tableName */
    protected $tableName = 'default';

    /**
     * EntityRepository constructor.
     * @param LoggerInterface $logger
     * @param ManagerRegistry $registry
     * @param string $entityClass
     */
    public function __construct(LoggerInterface $logger, ManagerRegistry $registry, $entityClass = '')
    {
        parent::__construct($registry, $entityClass);
        $this->logger = $logger;
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
        return $this->setAutoIncrements(1);
    }

    /**
     * @param int $value
     * @return bool
     */
    public function setAutoIncrements(int $value): bool
    {
        /* @noinspection SqlNoDataSourceInspection */
        $sql = "ALTER TABLE `{$this->tableName}` AUTO_INCREMENT = {$value};";

        try {
            return $this->getEntityManager()->getConnection()->prepare($sql)->execute();
        } catch (DBALException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

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
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return [];
        }

        return $this->createQueryBuilder('c')
            ->where("c.{$identifier} IN (:ids)")
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
            $query->execute();

            return $query->rowCount() > 0;
        } catch (DBALException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return false;
        }
    }

    /**
     * @return mixed|null
     */
    public function findOneLast()
    {
        try {
            $identifier = $this->getClassMetadata()->getSingleIdentifierFieldName();

            return $this->createQueryBuilder('a')
                ->orderBy("a.{$identifier}", 'ASC')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (ORMException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }

    /**
     * @return mixed|null
     */
    public function findOneFirst()
    {
        try {
            $identifier = $this->getClassMetadata()->getSingleIdentifierFieldName();

            return $this->createQueryBuilder('a')
                ->orderBy("a.{$identifier}", 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (ORMException $e) {
            $this->logger->error(ExceptionFormatter::f($e->getMessage()));

            return null;
        }
    }
}
