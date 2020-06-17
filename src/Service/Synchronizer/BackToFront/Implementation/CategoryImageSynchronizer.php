<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Front\Category as CategoryFront;
use App\Helper\Back\Store as StoreBack;
use App\Helper\ExceptionFormatter;
use App\Helper\Front\Store as StoreFront;
use App\Service\FrontBackFileSystem\GetBackFileInterface;
use App\Service\FrontBackFileSystem\SaveFrontFileInterface;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class CategoryImageSynchronizer extends BackToFrontSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var StoreBack $storeBack */
    protected $storeBack;

    /** @var GetBackFileInterface $fileReader */
    protected $fileReader;

    /** @var SaveFrontFileInterface $fileWriter */
    protected $fileWriter;

    /** @var string[] $backPath */
    protected $backPath = ['/images_big/', '/products_pictures/'];

    /** @var string $frontPath */
    protected $frontPath = '/date/categories/';

    /**
     * CategoryImageSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param StoreFront $storeFront
     * @param StoreBack $storeBack
     * @param GetBackFileInterface $fileReader
     * @param SaveFrontFileInterface $fileWriter
     * @param array $categoryImageBackPath
     * @param string $categoryImageFrontPath
     */
    public function __construct(
        LoggerInterface $logger,
        StoreFront $storeFront,
        StoreBack $storeBack,
        GetBackFileInterface $fileReader,
        SaveFrontFileInterface $fileWriter,
        array $categoryImageBackPath,
        string $categoryImageFrontPath
    )
    {
        $this->logger = $logger;
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
        $path = $this->storeFront->getDefaultSitePath() . $this->frontPath;
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

        $path = $this->storeBack->getDefaultSitePath() . $path;
        $content = $this->fileReader->getFile($path . $picture);
        if (null === $content) {
            return;
        }

        $pathInfo = pathinfo($picture);

        $name = $categoryFront->getCategoryId() . '.' . mb_strtolower($pathInfo['extension']);
        $path = $this->frontPath . $name;

        try {
            $this->fileWriter->saveFile($this->storeFront->getDefaultSitePath() . $path, $content);
        } catch (UploadException $exception) {
            $this->logger->error(ExceptionFormatter::f('Failed to save image'));

            return;
        }

        $categoryFront->setImage(str_replace('/image/', '', $path));
    }
}