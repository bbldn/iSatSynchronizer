<?php

namespace App\Command;

use Psr\Http\Message\ServerRequestInterface;
use React\EventLoop\Factory;
use React\Http\Response;
use React\Http\Server as HttpServer;
use React\Socket\Server as SocketServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class QueueHandlerCommand extends Command
{
    protected static $defaultName = 'queue:handle';

    /** @var string $handlerPort */
    protected $handlerPort;

    /** @var string $consolePath */
    protected $consolePath;

    /** @var array $processes */
    protected $processes = [];

    /**
     * QueueHandlerCommand constructor.
     * @param string $handlerPort
     * @param string $consolePath
     * @param string $name
     */
    public function __construct(string $handlerPort, string $consolePath, string $name = null)
    {
        $this->handlerPort = $handlerPort;
        $this->consolePath = $consolePath;
        parent::__construct($name);
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Queue handle');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $childPid = pcntl_fork();
        if ($childPid) {
            return 0;
        }
        posix_setsid();
        fclose(STDIN);
        fclose(STDOUT);
        fclose(STDERR);

        $this->startServer();

        return 0;
    }

    /**
     *
     */
    protected function startServer()
    {
        $path = $this->consolePath;
        $server = new HttpServer(function (ServerRequestInterface $request) use ($path) {
            $response = json_encode($this->handle($request->getParsedBody()));

            return new Response(200, ['Content-Type' => 'application/json'], $response);
        });

        $loop = Factory::create();
        $socket = new SocketServer("0.0.0.0:{$this->handlerPort}", $loop);
        $server->listen($socket);
        $loop->run();
    }

    /**
     * @param array $parameters
     * @return array
     */
    protected function handle(array $parameters)
    {
        $command = trim($parameters['command']);
        if ('stat' === $command) {
            $this->sortProcess();

            return ['ok' => true, 'list' => array_column($this->processes, 'command')];
        }

        $process = new Process(array_merge([$this->consolePath], explode(' ', $command)));
        $process->start();

        $command = "{$process->getPid()} {$command}";
        $this->processes[] = ['command' => $command, 'process' => $process];

        return ['ok' => true, 'command' => $command];
    }

    /**
     *
     */
    protected function sortProcess()
    {
        foreach ($this->processes as $key => $process) {
            /** @var Process $process */
            $process = $process['process'];
            if (false === $process->isRunning()) {
                unset($this->processes[$key]);
            }
        }

        sort($this->processes);
    }
}