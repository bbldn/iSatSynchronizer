<?php

namespace App\Service\FrontBackFileSystem;

use App\Helper\Front\Store as StoreFront;
use Symfony\Component\Filesystem\Filesystem;

class SaveFrontFileToFileSystem implements SaveFrontFileInterface
{
    /** @var Filesystem $fileSystem */
    protected $fileSystem;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /**
     * SaveFrontFileToFileSystem constructor.
     * @param Filesystem $fileSystem
     * @param StoreFront $storeFront
     */
    public function __construct(Filesystem $fileSystem, StoreFront $storeFront)
    {
        $this->fileSystem = $fileSystem;
        $this->storeFront = $storeFront;
    }

    /**
     * @param string $path
     * @param string $content
     */
    public function saveFile(string $path, string $content): void
    {
        $path = $this->storeFront->getDefaultSitePath() . $path;
        if (true === $this->fileSystem->exists($path)) {
            $this->fileSystem->remove($path);
        }

        $this->fileSystem->appendToFile($path, $content);
    }

    /**
     * @param string $path
     */
    public function clearFolder(string $path): void
    {
        $path = $this->storeFront->getDefaultSitePath() . $path;
        foreach (scandir($path) as $link) {
            if (true === in_array($link, ['.', '..',])) {
                continue;
            }

            $this->fileSystem->remove($path . $link);
        }
    }
}