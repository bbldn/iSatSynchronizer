<?php

namespace App\EventListener\BackToFront;

use App\Contract\BackToFront\CategoryImageSynchronizerContract;
use App\Event\BackToFront\CategoriesClearEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClearCategoriesImage implements EventSubscriberInterface
{
    /** @var CategoryImageSynchronizerContract $categoryImageHelper */
    protected $categoryImageHelper;

    /**
     * ClearCategoriesImage constructor.
     * @param CategoryImageSynchronizerContract $categoryImageHelper
     */
    public function __construct(CategoryImageSynchronizerContract $categoryImageHelper)
    {
        $this->categoryImageHelper = $categoryImageHelper;
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
            $this->categoryImageHelper->clearFolder();
        }
    }
}