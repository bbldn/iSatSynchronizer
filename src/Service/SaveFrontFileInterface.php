<?php

namespace App\Service;


interface SaveFrontFileInterface
{
    public function saveFile(string $path, string $content): void;
}