<?php

namespace App\Service\FrontBackFileSystem;

interface SaveFrontFileInterface
{
    public function saveFile(string $path, string $content): void;
    public function clearFolder(string $path): void;
}