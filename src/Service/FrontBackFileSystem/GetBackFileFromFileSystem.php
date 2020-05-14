<?php

namespace App\Service\FrontBackFileSystem;

use Symfony\Component\Filesystem\Filesystem;

class GetBackFileFromFileSystem implements GetBackFileInterface
{
    /** @var Filesystem $fileSystem */
    protected $fileSystem;

    /**
     * GetBackFileFromFileSystem constructor.
     * @param Filesystem $fileSystem
     */
    public function __construct(Filesystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    /**
     * @param string $path
     * @return string|null
     */
    public function getFile(string $path): ?string
    {
        if (false === $this->fileSystem->exists($path)) {
            return null;
        }

        $content = file_get_contents($path);
        if (false === $content || 0 === strlen($content)) {
            return null;
        }

        return $content;
    }
}