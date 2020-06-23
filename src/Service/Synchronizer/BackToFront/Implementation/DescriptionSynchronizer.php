<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Helper\ExceptionFormatter;
use App\Helper\Front\Store as StoreFront;
use App\Service\FrontBackFileSystem\GetBackFileInterface;
use App\Service\FrontBackFileSystem\SaveFrontFileInterface;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;
use Exception;
use Psr\Log\LoggerInterface;

class DescriptionSynchronizer extends BackToFrontSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var GetBackFileInterface $fileReader */
    protected $fileReader;

    /** @var SaveFrontFileInterface $fileWriter */
    protected $fileWriter;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var string $frontPath */
    protected $frontPath = '/image/catalog/description_product/';

    /**
     * DescriptionSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param GetBackFileInterface $fileReader
     * @param SaveFrontFileInterface $fileWriter
     * @param StoreFront $storeFront
     */
    public function __construct(
        LoggerInterface $logger,
        GetBackFileInterface $fileReader,
        SaveFrontFileInterface $fileWriter,
        StoreFront $storeFront
    )
    {
        $this->logger = $logger;
        $this->fileReader = $fileReader;
        $this->fileWriter = $fileWriter;
        $this->storeFront = $storeFront;
    }

    /**
     * @param string|null $text
     * @return string
     */
    protected function synchronize(?string $text): string
    {
        if (null === $text) {
            return $text;
        }

        preg_match_all('/src=\"(.+?)\"/', $text, $marches);
        if (2 !== count($marches)) {
            return $text;
        }

        $images = array_unique($marches[1]);

        foreach ($images as $image) {
            $fileName = $this->synchronizeImage($image);
            $text = $this->replace($text, $image, $fileName);
        }

        return $text;
    }

    /**
     * @param string $src
     * @return null|string
     */
    protected function synchronizeImage(string $src): ?string
    {
        $content = $this->getFile($src);
        if (null === $content) {
            return null;
        }

        $pathInfo = pathinfo($src);

        if (false === key_exists('basename', $pathInfo) && 0 === mb_strlen($pathInfo['basename'])) {
            return null;
        }

        $path = $this->frontPath . $pathInfo['basename'];
        $this->fileWriter->saveFile($this->storeFront->getDefaultSitePath() . $path, $content);

        return $path;
    }

    /**
     * @param string $text
     * @param string $oldPath
     * @param string|null $newPath
     * @return string
     */
    protected function replace(string &$text, string $oldPath, ?string $newPath): string
    {
        if (null !== $newPath) {
            return str_replace($oldPath, $newPath, $text);
        }

        return $text;
    }

    /**
     *
     */
    protected function clearFolder(): void
    {
        $this->fileWriter->clearFolder($this->storeFront->getDefaultSitePath() . $this->frontPath);
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