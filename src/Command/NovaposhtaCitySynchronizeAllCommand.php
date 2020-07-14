<?php

namespace App\Command;

use App\Contract\Novaposhta\CitySynchronizerContract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NovaposhtaCitySynchronizeAllCommand extends Command
{
    protected static $defaultName = 'novaposhta:city:synchronize:all';

    /** @var CitySynchronizerContract $citySynchronizer */
    protected $citySynchronizer;

    /**
     * NovaposhtaAreaSynchronizeAllCommand constructor.
     * @param CitySynchronizerContract $citySynchronizer
     */
    public function __construct(CitySynchronizerContract $citySynchronizer)
    {
        parent::__construct();
        $this->citySynchronizer = $citySynchronizer;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->citySynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->citySynchronizer->synchronizeAll();

        return 0;
    }
}