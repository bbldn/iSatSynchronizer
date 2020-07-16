<?php

namespace App\EventListener\BackToFront;

use App\Event\BackToFront\ProductsAllSynchronizedEvent;
use App\Event\BackToFront\ProductsSynchronizedEvent;
use App\Helper\ExceptionFormatter;
use App\Service\Other\SeoProCacheCleaner;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Throwable;

class ClearSeoProCache implements EventSubscriberInterface
{
    /** @var LoggerInterface $logger */
    protected $logger;

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
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger, SeoProCacheCleaner $cacheCleaner)
    {
        $this->logger = $logger;
        $this->cacheCleaner = $cacheCleaner;
    }

    /**
     *
     */
    public function action(): void
    {
        try {
            $this->cacheCleaner->clear();
        } catch (Throwable $e) {
            $this->logger->error(ExceptionFormatter::e($e));
        }
    }
}