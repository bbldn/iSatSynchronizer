<?php

namespace App\EventListener\BackToFront;

use App\Event\BackToFront\CategoriesClearEvent;
use App\Repository\Front\SeoUrlRepository as SeoUrlFrontRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ClearCategoriesSeoPro implements EventSubscriberInterface
{
    /** @var SeoUrlFrontRepository $seoUrlFrontRepository */
    protected $seoUrlFrontRepository;

    /** @var ?bool $seoUrlTableExists */
    protected $seoUrlTableExists = null;

    /**
     * ClearCategoriesSeoPro constructor.
     * @param SeoUrlFrontRepository $seoUrlFrontRepository
     */
    public function __construct(SeoUrlFrontRepository $seoUrlFrontRepository)
    {
        $this->seoUrlFrontRepository = $seoUrlFrontRepository;
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
     *
     */
    public function action(): void
    {
        if (null === $this->seoUrlTableExists) {
            $this->seoUrlTableExists = $this->seoUrlFrontRepository->tableExists();
        }

        if (true === $this->seoUrlTableExists) {
            $this->seoUrlFrontRepository->removeAllByQuery('category_id');
        }
    }
}