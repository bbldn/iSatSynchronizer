<?php

namespace App\Service\FrontBackFileSystem;

interface GetBackFileInterface
{
    /**
     * @param string $path
     * @return null|string
     */
    public function getFile(string $path): ?string;
}