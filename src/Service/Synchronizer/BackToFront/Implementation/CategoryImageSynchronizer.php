<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Front\Category as CategoryFront;
use App\Other\Back\Store as StoreBack;
use App\Other\Front\Store as StoreFront;
use App\Service\FrontBackFileSystem\GetBackFileInterface;
use App\Service\FrontBackFileSystem\SaveFrontFileInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class CategoryImageSynchronizer
{
    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var StoreBack $storeBack */
    protected $storeBack;

    /** @var GetBackFileInterface $fileReader */
    protected $fileReader;

    /** @var SaveFrontFileInterface $fileWriter */
    protected $fileWriter;

    /** @var array $backPath */
    protected $backPath = ['/images_big/', '/products_pictures/'];

    /** @var string $frontPath */
    protected $frontPath = '/date/categories/';

    /**
     * CategoryImageSynchronizer constructor.
     * @param StoreFront $storeFront
     * @param StoreBack $storeBack
     * @param GetBackFileInterface $fileReader
     * @param SaveFrontFileInterface $fileWriter
     * @param array $categoryImageBackPath
     * @param string $categoryImageFrontPath
     */
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

    /**
     *
     */
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

        $name = $categoryFront->getCategoryId() . '.' . mb_strtolower($pathInfo['extension']);
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