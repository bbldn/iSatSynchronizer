<?php

namespace App\Service\FrontBackFileSystem;

use App\Helper\Front\Store as StoreFront;
use http\Exception\InvalidArgumentException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FrontBackFileSystemFactory
{
    /**
     * @param Filesystem $fileSystem
     * @param HttpClientInterface $httpClient
     * @param string $type
     * @return GetBackFileFromFileSystem|GetBackFileFromNetwork
     */
    public static function createGetBackFileInstance(
        Filesystem $fileSystem,
        HttpClientInterface $httpClient,
        string $type = 'filesystem'
    ): GetBackFileInterface
    {
        switch ($type) {
            case 'filesystem':
                return new GetBackFileFromFileSystem($fileSystem);
            case 'network':
                return new GetBackFileFromNetwork($httpClient);
            default:
                throw new InvalidArgumentException("Unknown type: `{$type}`");
        }
    }

    /**
     * @param Filesystem $fileSystem
     * @param HttpClientInterface $httpClient
     * @param StoreFront $storeFront
     * @param string $token
     * @param string $type
     * @return SaveFrontFileToFileSystem|SaveFrontFileToNetwork
     */
    public static function createSaveFrontFileInstance(
        Filesystem $fileSystem,
        HttpClientInterface $httpClient,
        StoreFront $storeFront,
        string $token,
        string $type
    ): SaveFrontFileInterface
    {
        switch ($type) {
            case 'filesystem':
                return new SaveFrontFileToFileSystem($fileSystem, $storeFront);
            case 'network':
                return new SaveFrontFileToNetwork($httpClient, $storeFront, $token);
            default:
                throw new InvalidArgumentException("Unknown type: `{$type}`");
        }
    }
}