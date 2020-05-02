<?php

namespace App\Repository\Back;

use App\Other\EntityRepository;

class EntityBackRepository extends EntityRepository
{
    /** @var string $entityManagerName */
    protected $entityManagerName = 'back';
}