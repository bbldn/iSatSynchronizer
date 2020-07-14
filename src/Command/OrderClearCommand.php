<?php

namespace App\Command;

use App\Contract\FrontToBack\OrderSynchronizerContract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderClearCommand extends Command
{
    protected static $defaultName = 'order:clear';

    /** @var OrderSynchronizerContract $orderSynchronize */
    protected $orderSynchronize;

    /**
     * OrderClearCommand constructor.
     * @param OrderSynchronizerContract $orderSynchronizer
     */
    public function __construct(OrderSynchronizerContract $orderSynchronizer)
    {
        $this->orderSynchronize = $orderSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Clear orders');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->orderSynchronize->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->orderSynchronize->clear();

        return 0;
    }
}