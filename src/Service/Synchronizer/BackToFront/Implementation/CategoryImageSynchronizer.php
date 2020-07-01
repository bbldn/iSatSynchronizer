<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Category as CategoryBack;
use App\Entity\Front\Category as CategoryFront;
use App\Helper\Back\Store as StoreBack;
use App\Helper\ExceptionFormatter;
use App\Helper\Front\Store as StoreFront;
use App\Repository\Front\CategoryRepository as CategoryFrontRepository;
use App\Service\FrontBackFileSystem\GetBackFileInterface;
use App\Service\FrontBackFileSystem\SaveFrontFileInterface;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;
use Exception;
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

    /** @var CategoryFrontRepository $categoryFrontRepository */
    protected $categoryFrontRepository;

    /** @var GetBackFileInterface $fileReader */
    protected $fileReader;

    /** @var SaveFrontFileInterface $fileWriter */
    protected $fileWriter;

    /** @var string $backPath */
    protected $backPath = '/products_pictures/';

    /** @var string $frontPath */
    protected $frontPath = '/date/categories/';

    /**
     * CategoryImageSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param StoreFront $storeFront
     * @param StoreBack $storeBack
     * @param CategoryFrontRepository $categoryFrontRepository
     * @param GetBackFileInterface $fileReader
     * @param SaveFrontFileInterface $fileWriter
     * @param string $categoryImageBackPath
     * @param string $categoryImageFrontPath
     */
    public function __construct(
        LoggerInterface $logger,
        StoreFront $storeFront,
        StoreBack $storeBack,
        CategoryFrontRepository $categoryFrontRepository,
        GetBackFileInterface $fileReader,
        SaveFrontFileInterface $fileWriter,
        string $categoryImageBackPath,
        string $categoryImageFrontPath
    )
    {
        $this->logger = $logger;
        $this->storeFront = $storeFront;
        $this->storeBack = $storeBack;
        $this->categoryFrontRepository = $categoryFrontRepository;
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
        $this->fileWriter->clearFolder($this->frontPath);
    }

    /**
     * @param CategoryBack $categoryBack
     * @param CategoryFront $categoryFront
     */
    public function synchronizeImage(CategoryBack $categoryBack, CategoryFront $categoryFront): void
    {
        $picture = $categoryBack->getPicture();
        if (0 === mb_strlen($picture)) {
            return;
        }

        $path = $this->storeBack->getDefaultSitePath() . $this->backPath;
        $content = $this->getFile($path . $picture);
        if (null === $content) {
            return;
        }

        $pathInfo = pathinfo($picture);
        $name = $categoryFront->getCategoryId() . '.' . mb_strtolower($pathInfo['extension']);
        $path = $this->frontPath . $name;

        try {
            $this->fileWriter->saveFile($path, $content);
        } catch (UploadException $exception) {
            $message = 'Failed to save image';
            $this->logger->error(ExceptionFormatter::f($message));

            return;
        }

        $categoryFront->setImage(str_replace('/image/', '', $path));

        $this->categoryFrontRepository->persistAndFlush($categoryFront);
    }

    /**
     * @param string $path
     * @return string|null
     */
    protected function getFile(string $path): ?string
    {
        try {
            return $this->fileReader->getFile($path);
        } catch (Exception $e) {
            $error = "Error getting path: {$path}. Error: {$e->getMessage()}";
            $this->logger->error(ExceptionFormatter::f($error));

            return null;
        }
    }
}