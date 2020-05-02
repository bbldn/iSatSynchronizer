<?php

namespace App\Repository\Front;

use App\Other\EntityRepository;

class EntityFrontRepository extends EntityRepository
{
    /** @var string $entityManagerName */
    protected $entityManagerName = 'front';
}