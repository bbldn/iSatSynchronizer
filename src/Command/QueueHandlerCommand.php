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

    protected function configure()
    {
        $this->setDescription('Queue handle');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $port = 8081;
        $path = '/home/user/PhpstormProjects/iSatSynchronizer/bin/console';
        $server = new HttpServer(function (ServerRequestInterface $request) use ($path) {
            $parameters = $request->getParsedBody();

//            exec("nohup {$path} {$parameters['command']} > /dev/null 2>&1 &");

            return new Response(200, ['Content-Type' => 'application/json'], json_encode(['ok' => true]));
        });

        $loop = Factory::create();
        $socket = new SocketServer($port, $loop);
        $server->listen($socket);
        $loop->run();

        return 0;
    }
}