<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BaseRepository extends ServiceEntityRepository
{
    protected $entityManagerName = 'default';

    public function __construct(ManagerRegistry $registry, $entityClass = '')
    {
        parent::__construct($registry, $entityClass);
        $this->_em = $registry->getManager($this->entityManagerName);
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
}