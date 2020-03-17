<?php

namespace App\Service\FrontBackFileSystem;

interface GetBackFileInterface
{
    public function getFile(string $path): ?string;
}