<?php

namespace App\Command;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Response;
use React\Http\Server as HttpServer;
use React\Socket\Server as SocketServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use React\EventLoop\Factory;

class QueueHandlerCommand extends Command
{
    protected static $defaultName = 'queue:handle';
    protected $handlerPort;
    protected $consolePath;
    public function __construct($handlerPort, $consolePath, $name = null)
    {
        $this->handlerPort = $handlerPort;
        $this->consolePath = $consolePath;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setDescription('Queue handle');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $childPid = pcntl_fork();
        if ($childPid) {
            exit();
        }
        posix_setsid();
        fclose(STDIN);
        fclose(STDOUT);
        fclose(STDERR);

        $this->startServer();

        return 0;
    }

    protected function startServer()
    {
        $path = $this->consolePath;
        $server = new HttpServer(function (ServerRequestInterface $request) use ($path) {
            $parameters = $request->getParsedBody();
            exec("nohup {$path} {$parameters['command']} > /dev/null 2>&1 &");
            return new Response(200, ['Content-Type' => 'application/json'], json_encode(['ok' => true]));
        });

        $loop = Factory::create();
        $socket = new SocketServer($this->handlerPort, $loop);
        $server->listen($socket);
        $loop->run();
    }
}