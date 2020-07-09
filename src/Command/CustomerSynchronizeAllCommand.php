<?php

namespace App\Command;

use App\Contract\BackToFront\CustomerSynchronizerContract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomerSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'customer:synchronize:all';

    /** @var CustomerSynchronizerContract $customerSynchronizer */
    protected $customerSynchronizer;

    /**
     * CustomerSynchronizeAllCommand constructor.
     * @param CustomerSynchronizerContract $customerSynchronizer
     */
    public function __construct(CustomerSynchronizerContract $customerSynchronizer)
    {
        $this->customerSynchronizer = $customerSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure(): void
    {
        $this->setDescription('Synchronize customers');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->customerSynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->customerSynchronizer->synchronizeAll();

        return 0;
    }
}