<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Front\Category as CategoryFront;
use App\Other\Front\Store as StoreFront;
use App\Other\Back\Store as StoreBack;
use App\Service\FrontBackFileSystem\GetBackFileInterface;
use App\Service\FrontBackFileSystem\SaveFrontFileInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class CategoryImageSynchronizer
{
    private $storeFront;
    private $storeBack;
    private $fileReader;
    private $fileWriter;
    private $backPath = ['/images_big/', '/products_pictures/',];
    private $frontPath = '/date/categories/';

    public function __construct(
        StoreFront $storeFront,
        StoreBack $storeBack,
        GetBackFileInterface $fileReader,
        SaveFrontFileInterface $fileWriter,
        array $categoryImageBackPath,
        string $categoryImageFrontPath
    )
    {
        $this->storeFront = $storeFront;
        $this->storeBack = $storeBack;
        $this->fileReader = $fileReader;
        $this->fileWriter = $fileWriter;
        $this->backPath = $categoryImageBackPath;
        $this->frontPath = $categoryImageFrontPath;
    }

    public function clearFolder(): void
    {
        $path = $this->storeFront->getSitePath() . $this->frontPath;
        $this->fileWriter->clearFolder($path);
    }

    /**
     * @param CategoryBack $categoryBack
     * @param CategoryFront $categoryFront
     */
    public function synchronizeImage(CategoryBack $categoryBack, CategoryFront $categoryFront): void
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

        $path = $this->storeBack->getSitePath() . $path;
        $content = $this->fileReader->getFile($path . $picture);
        if (null === $content) {
            //@TODO Notify
            return;
        }

        $pathInfo = pathinfo($picture);

        $name = $categoryFront->getId() . '.' . mb_strtolower($pathInfo['extension']);
        $path = $this->frontPath . $name;

        try {
            $this->fileWriter->saveFile($this->storeFront->getSitePath() . $path, $content);
        } catch (UploadException $exception) {
            //@TODO Notify
            return;
        }

        $categoryFront->setImage(str_replace('/image', '', $path));
    }
}