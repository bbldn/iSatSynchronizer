<?php

namespace App\Command;

use App\Contract\Novaposhta\AreaSynchronizerContract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NovaposhtaAreaSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'novaposhta:area:synchronize:all';

    /** @var AreaSynchronizerContract $areaSynchronizer */
    protected $areaSynchronizer;

    /**
     * NovaposhtaAreaSynchronizeAllCommand constructor.
     * @param AreaSynchronizerContract $areaSynchronizer
     */
    public function __construct(AreaSynchronizerContract $areaSynchronizer)
    {
        parent::__construct();
        $this->areaSynchronizer = $areaSynchronizer;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->areaSynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->areaSynchronizer->synchronizeAll();

        return 0;
    }
}