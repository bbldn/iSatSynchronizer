<?php

namespace App\Command;

use App\Service\Synchronizer\FrontToBack\OrderSynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderSynchronizeCommand extends Command
{
    protected static $defaultName = 'order:synchronize';
    private $orderSynchronize;

    public function __construct(OrderSynchronizer $orderSynchronize)
    {
        $this->orderSynchronize = $orderSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Synchronize orders');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->orderSynchronize->synchronizeAll();

        return 0;
    }
}