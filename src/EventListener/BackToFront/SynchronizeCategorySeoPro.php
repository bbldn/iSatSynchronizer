<?php

namespace App\EventListener\BackToFront;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Front\SeoUrl as SeoUrlFront;
use App\Event\BackToFront\CategorySynchronizedEvent;
use App\Helper\Filler;
use App\Helper\Front\Store as StoreFront;
use App\Helper\Store;
use App\Repository\Back\CategoryRepository as CategoryBackRepository;
use App\Repository\Back\ProductRepository as ProductBackRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use App\Repository\Front\SeoUrlRepository as SeoUrlFrontRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SynchronizeCategorySeoPro implements EventSubscriberInterface
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var CategoryBackRepository $categoryBackRepository */
    protected $categoryBackRepository;

    /** @var CategoryFrontRepository $categoryFrontRepository */
    protected $categoryFrontRepository;

    /** @var SeoUrlFrontRepository $seoUrlFrontRepository */
    protected $seoUrlFrontRepository;

    /** @var ProductBackRepository $productBackRepository */
    protected $productBackRepository;

    /** @var bool $urlsLoaded */
    protected $urlsLoaded = false;

    /** @var string[] $urls */
    protected $urls = [];

    /** @var ?bool $seoUrlTableExists */
    protected $seoUrlTableExists = null;

    /**
     * SynchronizeCategorySeoPro constructor.
     * @param LoggerInterface $logger
     * @param StoreFront $storeFront
     * @param CategoryBackRepository $categoryBackRepository
     * @param CategoryFrontRepository $categoryFrontRepository
     * @param SeoUrlFrontRepository $seoUrlFrontRepository
     * @param ProductBackRepository $productBackRepository
     */
    public function __construct(
        LoggerInterface $logger,
        StoreFront $storeFront,
        CategoryBackRepository $categoryBackRepository,
        CategoryFrontRepository $categoryFrontRepository,
        SeoUrlFrontRepository $seoUrlFrontRepository,
        ProductBackRepository $productBackRepository
    )
    {
        $this->logger = $logger;
        $this->storeFront = $storeFront;
        $this->categoryBackRepository = $categoryBackRepository;
        $this->categoryFrontRepository = $categoryFrontRepository;
        $this->seoUrlFrontRepository = $seoUrlFrontRepository;
        $this->productBackRepository = $productBackRepository;
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
        if (null === $this->seoUrlTableExists) {
            $this->seoUrlTableExists = $this->seoUrlFrontRepository->tableExists();
        }

        if (false === $this->seoUrlTableExists) {
            return;
        }

        if (false === $this->urlsLoaded) {
            $this->getSeoUrlFromProducts();
            $this->urlsLoaded = true;
        }

        $category = $event->getCategory();

        $categoryBack = $this->categoryBackRepository->find($category->getBackId());
        if (null === $categoryBack) {
            //@TODO Notify
            return;
        }

        $seoUrl = $this->seoUrlFrontRepository->findOneByQueryAndLanguageId(
            "category_id={$category->getFrontId()}",
            $this->storeFront->getDefaultLanguageId()
        );

        $this->synchronizeSeoUrl($seoUrl, $category->getFrontId(), $categoryBack);
    }

    /**
     * @param SeoUrlFront|null $seoUrl
     * @param int $categoryFrontId
     * @param CategoryBack $categoryBack
     */
    protected function synchronizeSeoUrl(?SeoUrlFront $seoUrl, int $categoryFrontId, CategoryBack $categoryBack): void
    {
        if (null === $seoUrl) {
            $seoUrl = new SeoUrlFront();
        }

        $seoUrl->setStoreId($this->storeFront->getDefaultStoreId());
        $seoUrl->setLanguageId($this->storeFront->getDefaultLanguageId());
        $seoUrl->setQuery('category_id=' . $categoryFrontId);

        $slug = trim(Filler::securityString($categoryBack->getSlug()));

        if (0 === mb_strlen($slug)) {
            if (true === key_exists($categoryBack->getCategoryId(), $this->urls)) {
                $slug = $this->urls[$categoryBack->getCategoryId()];
            } else {
                $slug = StoreFront::generateURL(
                    $categoryBack->getCategoryId(),
                    Store::encodingConvert($categoryBack->getName())
                );
            }

            $seoUrl->setKeyword($slug);
        } else {
            $seoUrl->setKeyword($slug);
        }

        $this->seoUrlFrontRepository->persistAndFlush($seoUrl);
    }

    /**
     * @return array
     */
    protected function getSeoUrlFromProducts(): array
    {
        $urls = [];
        $slugs = $this->productBackRepository->getAllSlugs();

        foreach ($slugs as $slug) {
            $result = preg_match('/^([0-9]+)(.+)?\/([0-9]+)(.+)$/', $slug['slug'], $data);
            if (0 === $result) {
                continue;
            }

            $urls[$data[1]] = $data[1] . $data[2];
        }

        return $urls;
    }
}