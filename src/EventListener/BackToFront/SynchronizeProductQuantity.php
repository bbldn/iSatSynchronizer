<?php

namespace App\EventListener\BackToFront;


use App\Event\BackToFront\ProductSynchronizedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SynchronizeProductQuantity implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ProductSynchronizedEvent::class => 'action',
        ];
    }

    public function action(ProductSynchronizedEvent $event): void
    {
//        $event->getProduct()
    }
}