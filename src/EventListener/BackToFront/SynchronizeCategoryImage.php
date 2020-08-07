<?php

namespace App\EventListener\BackToFront;

use App\Contract\BackToFront\CategoryImageSynchronizerInterface;
use App\Event\BackToFront\CategorySynchronizedEvent;
use App\Exception\CategoryBackNotFoundException;
use App\Exception\CategoryFrontNotFoundException;
use App\Exception\CategoryNotFoundException;
use App\Helper\ExceptionFormatter;
use App\Repository\Back\CategoryRepository as CategoryBackRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Throwable;

class SynchronizeCategoryImage implements EventSubscriberInterface
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var CategoryFrontRepository $categoryFrontRepository */
    protected $categoryFrontRepository;

    /** @var CategoryBackRepository $categoryBackRepository */
    protected $categoryBackRepository;

    /** @var CategoryImageSynchronizerInterface $categoryImageSynchronizer */
    protected $categoryImageSynchronizer;

    /**
     * SynchronizeCategoryImage constructor.
     * @param LoggerInterface $logger
     * @param CategoryFrontRepository $categoryFrontRepository
     * @param CategoryBackRepository $categoryBackRepository
     * @param CategoryImageSynchronizerInterface $categoryImageSynchronizer
     */
    public function __construct(
        LoggerInterface $logger,
        CategoryFrontRepository $categoryFrontRepository,
        CategoryBackRepository $categoryBackRepository,
        CategoryImageSynchronizerInterface $categoryImageSynchronizer
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
        try {
            $this->_action($event);
        } catch (Throwable $e) {
            $this->logger->error(ExceptionFormatter::e($e));
        }
    }

    /**
     * @param CategorySynchronizedEvent $event
     * @throws CategoryBackNotFoundException
     * @throws CategoryFrontNotFoundException
     * @throws CategoryNotFoundException
     */
    protected function _action(CategorySynchronizedEvent $event): void
    {
        if (false === $event->isSynchronizeImage()) {
            return;
        }

        $category = $event->getCategory();
        if (null === $category) {
            throw new CategoryNotFoundException("Category not found");
        }

        $categoryBack = $this->categoryBackRepository->find($category->getBackId());
        if (null === $categoryBack) {
            throw new CategoryBackNotFoundException("Category back with id: {$category->getBackId()}");
        }

        $categoryFront = $this->categoryFrontRepository->find($category->getFrontId());
        if (null === $categoryFront) {
            throw new CategoryFrontNotFoundException("Category front with id: {$category->getFrontId()}");
        }

        $this->categoryImageSynchronizer->synchronizeImage($categoryBack, $categoryFront);
    }
}