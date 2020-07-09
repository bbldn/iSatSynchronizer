<?php

namespace App\Command;

use App\Service\Synchronizer\FrontToBack\OrderSynchronizer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderClearCommand extends Command
{
    protected static $defaultName = 'order:clear';

    /** @var OrderSynchronizer $orderSynchronize */
    protected $orderSynchronize;

    /**
     * OrderClearCommand constructor.
     * @param OrderSynchronizer $orderSynchronizer
     */
    public function __construct(OrderSynchronizer $orderSynchronizer)
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