<?php

namespace App\Service\FrontBackFileSystem;

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

        $content = file_get_contents($path);

        if (false === $content || 0 === strlen($content)) {
            return null;
        }

        return $content;
    }
}