<?php

namespace App\Service\FrontBackFileSystem;

use Symfony\Component\Filesystem\Filesystem;

class SaveFrontFileToFileSystem implements SaveFrontFileInterface
{
    private $fileSystem;

    public function __construct(Filesystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    public function saveFile(string $path, string $content): void
    {
        $this->fileSystem->appendToFile($path, $content);
    }
}