<?php

namespace App\EventListener\BackToFront;

use App\Contract\BackToFront\CategoryImageSynchronizerInterface;
use App\Event\BackToFront\CategoriesClearEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClearCategoriesImage implements EventSubscriberInterface
{
    /** @var CategoryImageSynchronizerInterface $categoryImageHelper */
    protected $categoryImageHelper;

    /**
     * ClearCategoriesImage constructor.
     * @param CategoryImageSynchronizerInterface $categoryImageHelper
     */
    public function __construct(CategoryImageSynchronizerInterface $categoryImageHelper)
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