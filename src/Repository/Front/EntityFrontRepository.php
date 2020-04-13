<?php

namespace App\Repository\Front;

use App\Other\EntityRepository;

class EntityFrontRepository extends EntityRepository
{
    protected $entityManagerName = 'front';
}