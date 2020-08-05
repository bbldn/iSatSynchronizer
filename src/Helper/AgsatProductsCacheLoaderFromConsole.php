<?php

namespace App\Helper;

use App\Contract\AgsatProductsCacheLoaderInterface;
use JsonException;
use Symfony\Component\Process\Process;

class AgsatProductsCacheLoaderFromConsole implements AgsatProductsCacheLoaderInterface
{
    /** @var string $path */
    protected $path;

    /** @var string $command */
    protected $command;

    /**
     * AgsatProductsCacheLoaderFromConsole constructor.
     * @param string $path
     * @param string $command
     */
    public function __construct(string $path, string $command)
    {
        $this->path = $path;
        $this->command = $command;
    }

    /**
     * @return array
     * @throws JsonException
     */
    public function load(): array
    {
        $process = new Process([$this->path, $this->command]);
        $process->run();

        $result = json_decode($process->getOutput(), true);

        if (false === $result) {
            throw new JsonException('Error parse output');
        }

        return $result;
    }
}