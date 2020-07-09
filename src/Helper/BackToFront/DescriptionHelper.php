<?php

namespace App\Helper\BackToFront;

use App\Contract\BackToFront\DescriptionHelperContract;
use App\Helper\ExceptionFormatter;
use App\Helper\Front\Store as StoreFront;
use App\Service\FrontBackFileSystem\GetBackFileInterface;
use App\Service\FrontBackFileSystem\SaveFrontFileInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class DescriptionHelper implements DescriptionHelperContract
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
     *
     */
    public function load(): void
    {
    }

    /**
     * @param string|null $text
     * @return string
     */
    public function synchronize(?string $text): string
    {
        if (null === $text) {
            return $text;
        }

        preg_match_all('/src=\"(https?:\/\/isat\.com\.ua.+?)\"/', $text, $marches);
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

        try {
            $this->fileWriter->saveFile($path, $content);
        } catch (Throwable $e) {
            $message = "Error image save: {$e->getMessage()}";
            $this->logger->error(ExceptionFormatter::f($message));

            return null;
        }

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
    public function clearFolder(): void
    {
        try {
            $this->fileWriter->clearFolder($this->frontPath);
        } catch (Throwable $e) {
            $message = "Error clear folder: {$e->getMessage()}";
            $this->logger->error(ExceptionFormatter::f($message));
        }
    }

    /**
     * @param string $path
     * @return string|null
     */
    protected function getFile(string $path): ?string
    {
        try {
            return $this->fileReader->getFile(
                preg_replace('/https?:\/\/isat\.com\.ua/', 'https://admin.isat.com.ua', $path)
            );
        } catch (Throwable $e) {
            $error = "Error getting path: {$path}. Error: {$e->getMessage()}";
            $this->logger->error(ExceptionFormatter::f($error));

            return null;
        }
    }
}