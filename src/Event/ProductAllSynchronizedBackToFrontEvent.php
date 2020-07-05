<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class ProductAllSynchronizedBackToFrontEvent extends Event
{
    public const NAME = 'product.all.synchronized.backToFront';
}