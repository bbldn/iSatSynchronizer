<?php

namespace App\Command;

use App\Exception\OrderFrontNotFoundException;
use App\Service\Synchronizer\FrontToBack\OrderSynchronize;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderOneSynchronizeCommand extends OneSynchronizeCommand
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
        $this->addArgument('id', InputArgument::REQUIRED, 'Reset image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = $this->parseId($input);

        try {
            $this->orderSynchronize->synchronizeOne($id);
        } catch (OrderFrontNotFoundException $notFoundException) {
            throw new \InvalidArgumentException("Order Front with `id`: {$id} not found");
        }

        return 0;
    }
}