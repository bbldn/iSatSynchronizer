<?php

namespace App\Command;

use App\Contract\BackToFront\CurrencySynchronizerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CurrencySynchronizeAllCommand extends Command
{
    protected static $defaultName = 'currency:synchronize:all';

    /** @var CurrencySynchronizerInterface $currencySynchronizer */
    protected $currencySynchronizer;

    /**
     * CurrencySynchronizeAllCommand constructor.
     * @param CurrencySynchronizerInterface $currencySynchronizer
     */
    public function __construct(CurrencySynchronizerInterface $currencySynchronizer)
    {
        $this->currencySynchronizer = $currencySynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure(): void
    {
        $this->setDescription('Currency all');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->currencySynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->currencySynchronizer->synchronizeAll();

        return 0;
    }
}