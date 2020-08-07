<?php

namespace App\Command;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use React\EventLoop\Factory;
use React\Http\Response;
use React\Http\Server as HttpServer;
use React\Socket\Server as SocketServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DebugServerCommand extends Command
{
    protected static $defaultName = 'debug:server:start';

    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var string $debugServerPort */
    protected $debugServerPort;

    /**
     * DebugServerCommand constructor.
     * @param LoggerInterface $logger
     * @param string $debugServerPort
     */
    public function __construct(LoggerInterface $logger, string $debugServerPort)
    {
        parent::__construct();
        $this->logger = $logger;
        $this->debugServerPort = $debugServerPort;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $server = new HttpServer(function (ServerRequestInterface $request) {
            dump($request->getParsedBody());

            return new Response(200, ['Content-Type' => 'application/json'], json_encode(['ok' => true]));
        });

        $loop = Factory::create();
        $socket = new SocketServer("0.0.0.0:{$this->debugServerPort}", $loop);
        $server->listen($socket);
        $loop->run();

        return Command::SUCCESS;
    }
}