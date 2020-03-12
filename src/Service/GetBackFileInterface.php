<?php

namespace App\Service;


interface GetBackFileInterface
{
    public function getFile(string $path): ?string;
}