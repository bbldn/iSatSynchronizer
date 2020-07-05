<?php

namespace App\EventListener;

use App\Event\BackToFront\ProductsAllSynchronizedEvent;
use App\Event\BackToFront\ProductsSynchronizedEvent;
use App\Service\Other\SeoProCacheCleaner;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClearSeoProCache implements EventSubscriberInterface
{
    /** @var SeoProCacheCleaner $cacheCleaner */
    protected $cacheCleaner;

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ProductsAllSynchronizedEvent::class => 'action',
            ProductsSynchronizedEvent::class => 'action',
        ];
    }

    /**
     * ClearSeoProCache constructor.
     * @param SeoProCacheCleaner $cacheCleaner
     */
    public function __construct(SeoProCacheCleaner $cacheCleaner)
    {
        $this->cacheCleaner = $cacheCleaner;
    }

    /**
     *
     */
    public function action(): void
    {
        $this->cacheCleaner->clear();
    }
}