<?php

namespace App\Service\Synchronizer;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Category;
use App\Entity\Front\Category as CategoryFront;
use App\Entity\Front\CategoryDescription;
use App\Entity\Front\CategoryLayout;
use App\Entity\Front\CategoryStore;
use App\Other\Fillers\CategoryDescriptionFiller;
use App\Other\Fillers\CategoryFiller;
use App\Other\Fillers\CategoryLayoutFiller;
use App\Other\Fillers\CategoryStoreFiller;
use App\Other\Store;
use App\Repository\Back\CategoryRepository as CategoryBackRepository;
use App\Repository\CategoryRepository;
use App\Repository\Front\CategoryDescriptionRepository as CategoryDescriptionFrontRepository;
use App\Repository\Front\CategoryLayoutRepository as CategoryLayoutFrontRepository;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use App\Repository\Front\CategoryStoreRepository as CategoryStoreFrontRepository;
use App\Service\GetBackFileInterface;
use App\Service\SaveFrontFileInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CategorySynchronize
{
    private $categoryBackRepository;
    private $categoryFrontRepository;
    private $categoryDescriptionFrontRepository;
    private $categoryLayoutFrontRepository;
    private $categoryStoreFrontRepository;
    private $categoryRepository;
    private $filesystem;
    private $fileReader;
    private $fileWriter;
    private $httpClient;
    private $store;

    public function __construct(CategoryBackRepository $categoryBackRepository,
                                CategoryFrontRepository $categoryFrontRepository,
                                CategoryDescriptionFrontRepository $categoryDescriptionFrontRepository,
                                CategoryLayoutFrontRepository $categoryLayoutFrontRepository,
                                CategoryStoreFrontRepository $categoryStoreFrontRepository,
                                CategoryRepository $categoryRepository,
                                Filesystem $filesystem,
                                GetBackFileInterface $fileReader,
                                HttpClientInterface $httpClient,
                                SaveFrontFileInterface $fileWriter,
                                Store $store)
    {
        $this->categoryBackRepository = $categoryBackRepository;
        $this->categoryFrontRepository = $categoryFrontRepository;
        $this->categoryDescriptionFrontRepository = $categoryDescriptionFrontRepository;
        $this->categoryLayoutFrontRepository = $categoryLayoutFrontRepository;
        $this->categoryStoreFrontRepository = $categoryStoreFrontRepository;
        $this->categoryRepository = $categoryRepository;
        $this->fileReader = $fileReader;
        $this->fileWriter = $fileWriter;
        $this->filesystem = $filesystem;
        $this->httpClient = $httpClient;
        $this->store = $store;
    }

    public function clear(bool $synchronizeImage = false)
    {
        $this->categoryFrontRepository->removeAll();
        $this->categoryDescriptionFrontRepository->removeAll();
        $this->categoryLayoutFrontRepository->removeAll();
        $this->categoryStoreFrontRepository->removeAll();
        $this->categoryRepository->removeAll();
    }

    public function reload(bool $synchronizeImage = false)
    {
        $this->clear($synchronizeImage);
        $this->synchronize($synchronizeImage);
    }

    public function synchronize(bool $synchronizeImage = false)
    {
        $categoriesBack = $this->categoryBackRepository->findAll();
        foreach ($categoriesBack as $categoryBack) {
            $category = $this->categoryRepository->findOneByBackId($categoryBack->getCategoryId());
            $categoryFront = null;
            if (null === $category) {
                $categoryFront = $this->createCategoryFrontFromBackCategory($categoryBack);
                $this->createCategoryFromBackAndFrontCategoryId($categoryBack->getCategoryId(), $categoryFront->getCategoryId());
            } else {
                $categoryFront = $this->categoryFrontRepository->find($category->getFrontId());
                if (null === $categoryFront) {
                    $this->categoryRepository->remove($category);
                    $categoryFront = $this->createCategoryFrontFromBackCategory($categoryBack);
                    $this->createCategoryFromBackAndFrontCategoryId($categoryBack->getCategoryId(), $categoryFront->getCategoryId());
                } else {
                    $this->updateCategoryFrontFromBackCategory($categoryBack, $categoryFront);
                    $this->categoryRepository->saveAndFlush($category);
                }
            }
            if ($synchronizeImage && null !== $categoryFront) {
                $this->synchronizeImage($categoryBack, $categoryFront);
            }
        }
    }

    protected function createCategoryFrontFromBackCategory(CategoryBack $categoryBack)
    {
        $parentBackId = $categoryBack->getParent();
        $parentId = $this->store->getDefaultCategoryFrontId();

        if (!in_array($parentBackId, $this->store->getRootCategories())) {
            $parentId = $this->getParentFrontIdByBackId($parentBackId);
        }

        $categoryFront = new CategoryFront();
        CategoryFiller::backToFront($categoryBack, $categoryFront, $parentId);
        $this->categoryFrontRepository->saveAndFlush($categoryFront);

        $categoryFrontId = $categoryFront->getCategoryId();

        $categoryDescription = new CategoryDescription();
        $languageId = $this->store->getDefaultLanguageId();
        CategoryDescriptionFiller::backToFront($categoryBack, $categoryDescription, $categoryFrontId, $languageId);
        $this->categoryDescriptionFrontRepository->saveAndFlush($categoryDescription);

        $categoryLayout = new CategoryLayout();
        $storeId = $this->store->getDefaultStoreId();
        $layoutId = $this->store->getDefaultLayoutId();
        CategoryLayoutFiller::backToFront($categoryLayout, $categoryFrontId, $storeId, $layoutId);
        $this->categoryLayoutFrontRepository->saveAndFlush($categoryLayout);

        $categoryStore = new CategoryStore();
        CategoryStoreFiller::backToFront($categoryStore, $categoryFrontId, $storeId);
        $this->categoryStoreFrontRepository->saveAndFlush($categoryStore);

        return $categoryFront;
    }

    protected function getParentFrontIdByBackId(int $backId)
    {
        $category = $this->categoryRepository->findOneByBackId($backId);
        if (null === $category) {
            //@TODO Notify
            return $this->store->getDefaultCategoryFrontId();
        }

        $frontId = $category->getFrontId();
        if (null === $frontId) {
            //@TODO Notify
            return $this->store->getDefaultCategoryFrontId();
        }

        $front = $this->categoryFrontRepository->find($frontId);

        if (null === $front) {
            //@TODO Notify
            return $this->store->getDefaultCategoryFrontId();
        }

        return $front->getCategoryId();
    }

    protected function createCategoryFromBackAndFrontCategoryId(int $backId, int $frontId)
    {
        $category = new Category();
        $category->setBackId($backId);
        $category->setFrontId($frontId);
        $this->categoryRepository->saveAndFlush($category);
    }

    protected function updateCategoryFrontFromBackCategory(CategoryBack $categoryBack, CategoryFront $categoryFront)
    {
        $parentBackId = $categoryBack->getParent();
        $parentId = $this->store->getDefaultCategoryFrontId();
        if (!in_array($parentBackId, $this->store->getRootCategories())) {
            $parentId = $this->getParentFrontIdByBackId($parentBackId);
        }
        CategoryFiller::backToFront($categoryBack, $categoryFront, $parentId);
        $this->categoryFrontRepository->saveAndFlush($categoryFront);

        $categoryFrontId = $categoryFront->getCategoryId();
        $categoryDescription = $this->categoryDescriptionFrontRepository->find($categoryFrontId);
        if (null === $categoryDescription) {
            $categoryDescription = new CategoryDescription();
        }
        $languageId = $this->store->getDefaultLanguageId();
        CategoryDescriptionFiller::backToFront($categoryBack, $categoryDescription, $categoryFrontId, $languageId);
        $this->categoryDescriptionFrontRepository->saveAndFlush($categoryDescription);

        $categoryLayout = $this->categoryLayoutFrontRepository->find($categoryFrontId);
        if (null === $categoryLayout) {
            $categoryLayout = new CategoryLayout();
        }
        $storeId = $this->store->getDefaultStoreId();
        $layoutId = $this->store->getDefaultLayoutId();
        CategoryLayoutFiller::backToFront($categoryLayout, $categoryFrontId, $storeId, $layoutId);
        $this->categoryLayoutFrontRepository->saveAndFlush($categoryLayout);

        $categoryStore = $this->categoryStoreFrontRepository->find($categoryFrontId);
        if (null === $categoryStore) {
            $categoryStore = new CategoryStore();
        }
        CategoryStoreFiller::backToFront($categoryStore, $categoryFrontId, $storeId);
        $this->categoryStoreFrontRepository->saveAndFlush($categoryStore);

        return $categoryFrontId;
    }

    /**
     * @param CategoryBack $categoryBack
     * @param CategoryFront $categoryFront
     */
    protected function synchronizeImage(CategoryBack $categoryBack,
                                        CategoryFront $categoryFront)
    {
        $picture = $categoryBack->getBigImage();
        $path = '/images_big/';

        if (null === $picture) {
            $picture = $categoryBack->getPicture();
            $path = '/products_pictures/';
        }

        if (null === $picture) {
            return;
        }

        $path = $this->store->getBackSitePath() . $path;
        $content = $this->fileReader->getFile($path . $picture);
        if (null === $content) {
            //@TODO Notify
            return;
        }

        $name = $categoryFront->getCategoryId() . '.jpg';
        $path = '/date/categories/' . $name;

        try {
            $this->fileWriter->saveFile($this->store->getFrontSitePath() . $path, $content);
        } catch (UploadException $exception) {
            //@TODO Notify
            return;
        }

        $categoryFront->setImage($path);
        $this->categoryFrontRepository->saveAndFlush($categoryFront);
    }
}