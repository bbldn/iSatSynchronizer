<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;

class GetBackFileFromFileSystem implements GetBackFileInterface
{
    private $fileSystem;

    public function __construct(Filesystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    public function getFile(string $path): ?string
    {
        if (!$this->fileSystem->exists($path)) {
            return null;
        }

        return file_get_contents($path);
    }
}