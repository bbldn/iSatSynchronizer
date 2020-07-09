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
     * @param OrderSynchronizer $orderSynchronize
     */
    public function __construct(OrderSynchronizer $orderSynchronize)
    {
        $this->orderSynchronize = $orderSynchronize;
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
     *
     */
    protected function load(): void
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
        parent::execute($input, $output);
        $this->orderSynchronize->clear();

        return 0;
    }
}