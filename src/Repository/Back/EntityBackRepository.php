<?php

namespace App\Repository\Back;

use App\Other\EntityRepository;

class EntityBackRepository extends EntityRepository
{
    protected $entityManagerName = 'back';
}