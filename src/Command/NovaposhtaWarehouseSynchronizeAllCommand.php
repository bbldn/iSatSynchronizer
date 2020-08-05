<?php

namespace App\Command;

use App\Contract\Novaposhta\WarehouseSynchronizerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NovaposhtaWarehouseSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'novaposhta:warehouse:synchronize:all';

    /** @var WarehouseSynchronizerInterface $warehousesSynchronizer */
    protected $warehousesSynchronizer;

    /**
     * NovaposhtaWarehouseSynchronizeAllCommand constructor.
     * @param WarehouseSynchronizerInterface $warehousesSynchronizer
     */
    public function __construct(WarehouseSynchronizerInterface $warehousesSynchronizer)
    {
        parent::__construct();
        $this->warehousesSynchronizer = $warehousesSynchronizer;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->warehousesSynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->warehousesSynchronizer->synchronizeAll();

        return 0;
    }
}