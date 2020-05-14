<?php

namespace App\Service\FrontBackFileSystem;

interface GetBackFileInterface
{
    /**
     * @param string $path
     * @return string|null
     */
    public function getFile(string $path): ?string;
}