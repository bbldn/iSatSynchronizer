<?php

namespace App\Command;

use App\Service\Synchronizer\FrontToBack\OrderSynchronize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderClearCommand extends Command
{
    protected static $defaultName = 'order:clear';
    private $orderSynchronize;

    public function __construct(OrderSynchronize $orderSynchronize)
    {
        $this->orderSynchronize = $orderSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Clear orders');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->orderSynchronize->clear();

        return 0;
    }
}