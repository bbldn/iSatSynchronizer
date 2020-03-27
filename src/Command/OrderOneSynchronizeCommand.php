<?php

namespace App\Command;

use App\Exception\OrderFrontNotFoundException;
use App\Service\Synchronizer\FrontToBack\OrderSynchronize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderOneSynchronizeCommand extends Command
{
    protected static $defaultName = 'order:one:synchronize';
    private $orderSynchronize;

    public function __construct(OrderSynchronize $orderSynchronize)
    {
        $this->orderSynchronize = $orderSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Order one synchronize');
        $this->addArgument('idOrder', InputArgument::OPTIONAL, 'Reset image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input->getArgument('idOrder') === null) {
            $output->writeln("Parameter `id` not found");
        }

        $id = $input->getArgument('idOrder');
        if (0 === preg_match('/[0-9]+/', $id)) {
            $output->writeln("`id` must be int: {$id}");

            return -1;
        }

        try {
            $this->orderSynchronize->synchronizeOne((int)$id);
        } catch (OrderFrontNotFoundException $notFoundException) {
            $output->writeln("Order Front with `id`: {$id} not found");

            return -1;
        }

        return 0;
    }
}