<?php

namespace App\Service\FrontBackFileSystem;

interface SaveFrontFileInterface
{
    /**
     * @param string $path
     * @param string $content
     */
    public function saveFile(string $path, string $content): void;

    /**
     * @param string $path
     */
    public function clearFolder(string $path): void;
}