<?php

namespace App\EventListener\BackToFront;

use App\Contract\BackToFront\CategoryImageSynchronizerContract;
use App\Event\BackToFront\CategorySynchronizedEvent;
use App\Repository\Back\CategoryRepository as CategoryBackRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SynchronizeCategoryImage implements EventSubscriberInterface
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var CategoryFrontRepository $categoryFrontRepository */
    protected $categoryFrontRepository;

    /** @var CategoryBackRepository $categoryBackRepository */
    protected $categoryBackRepository;

    /** @var CategoryImageSynchronizerContract $categoryImageSynchronizer */
    protected $categoryImageSynchronizer;

    /**
     * SynchronizeCategoryImage constructor.
     * @param LoggerInterface $logger
     * @param CategoryFrontRepository $categoryFrontRepository
     * @param CategoryBackRepository $categoryBackRepository
     * @param CategoryImageSynchronizerContract $categoryImageSynchronizer
     */
    public function __construct(
        LoggerInterface $logger,
        CategoryFrontRepository $categoryFrontRepository,
        CategoryBackRepository $categoryBackRepository,
        CategoryImageSynchronizerContract $categoryImageSynchronizer
    )
    {
        $this->logger = $logger;
        $this->categoryFrontRepository = $categoryFrontRepository;
        $this->categoryBackRepository = $categoryBackRepository;
        $this->categoryImageSynchronizer = $categoryImageSynchronizer;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            CategorySynchronizedEvent::class => 'action'
        ];
    }

    /**
     * @param CategorySynchronizedEvent $event
     */
    public function action(CategorySynchronizedEvent $event): void
    {
        if (false === $event->isSynchronizeImage()) {
            return;
        }

        $category = $event->getCategory();
        $categoryBack = $this->categoryBackRepository->find($category->getBackId());
        if (null === $categoryBack) {
            //@TODO Notify
            return;
        }

        $categoryFront = $this->categoryFrontRepository->find($category->getFrontId());
        if (null === $categoryFront) {
            //@TODO Notify
            return;
        }


        $this->categoryImageSynchronizer->synchronizeImage($categoryBack, $categoryFront);
    }
}