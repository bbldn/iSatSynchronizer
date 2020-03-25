<?php

namespace App\Service\Synchronizer;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Front\Category as CategoryFront;
use App\Other\Store;
use App\Service\FrontBackFileSystem\GetBackFileInterface;
use App\Service\FrontBackFileSystem\SaveFrontFileInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class CategoryImageSynchronizer
{
    private $fileReader;
    private $fileWriter;
    private $store;
    private $backPath = ['/images_big/', '/products_pictures/',];
    private $frontPath = '/date/categories/';

    public function __construct(GetBackFileInterface $fileReader,
                                SaveFrontFileInterface $fileWriter,
                                Store $store,
                                array $categoryImageBackPath,
                                string $categoryImageFrontPath)
    {
        $this->fileReader = $fileReader;
        $this->fileWriter = $fileWriter;
        $this->store = $store;
        $this->backPath = $categoryImageBackPath;
        $this->frontPath = $categoryImageFrontPath;
    }

    public function clearFolder()
    {
        $path = $this->store->getFrontSitePath() . $this->frontPath;
        $this->fileWriter->clearFolder($path);
    }

    /**
     * @param CategoryBack $categoryBack
     * @param CategoryFront $categoryFront
     */
    public function synchronizeImage(CategoryBack $categoryBack, CategoryFront $categoryFront)
    {
        $picture = $categoryBack->getBigImage();
        $path = $this->backPath[0];

        if (null === $picture) {
            $picture = $categoryBack->getPicture();
            $path = $this->backPath[1];
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

        $pathInfo = pathinfo($picture);

        $name = $categoryFront->getCategoryId() . '.' . mb_strtolower($pathInfo['extension']);
        $path = $this->frontPath . $name;

        try {
            $this->fileWriter->saveFile($this->store->getFrontSitePath() . $path, $content);
        } catch (UploadException $exception) {
            //@TODO Notify
            return;
        }

        $categoryFront->setImage(str_replace('/image', '', $path));
    }
}