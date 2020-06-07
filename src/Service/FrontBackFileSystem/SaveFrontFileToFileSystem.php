<?php

namespace App\Service\FrontBackFileSystem;

use Symfony\Component\Filesystem\Filesystem;

class SaveFrontFileToFileSystem implements SaveFrontFileInterface
{
    /** @var Filesystem $fileSystem */
    protected $fileSystem;

    /**
     * SaveFrontFileToFileSystem constructor.
     * @param Filesystem $fileSystem
     */
    public function __construct(Filesystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    /**
     * @param string $path
     * @param string $content
     */
    public function saveFile(string $path, string $content): void
    {
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
        foreach (scandir($path) as $link) {
            if (true === in_array($link, ['.', '..',])) {
                continue;
            }

            $this->fileSystem->remove($path . $link);
        }
    }
}