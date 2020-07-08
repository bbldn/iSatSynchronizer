<?php

namespace App\EventListener\BackToFront;

use App\Event\BackToFront\CategoriesClearEvent;
use App\Service\Synchronizer\BackToFront\Implementation\CategoryImageSynchronizer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClearCategoriesImage implements EventSubscriberInterface
{
    /** @var CategoryImageSynchronizer $categoryImageSynchronizer */
    protected $categoryImageSynchronizer;

    /**
     * ClearCategoriesImage constructor.
     * @param CategoryImageSynchronizer $categoryImageSynchronizer
     */
    public function __construct(CategoryImageSynchronizer $categoryImageSynchronizer)
    {
        $this->categoryImageSynchronizer = $categoryImageSynchronizer;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            CategoriesClearEvent::class => 'action'
        ];
    }

    /**
     * @param CategoriesClearEvent $event
     */
    public function action(CategoriesClearEvent $event)
    {
        if (true === $event->isClearImage()) {
            $this->categoryImageSynchronizer->clearFolder();
        }
    }
}