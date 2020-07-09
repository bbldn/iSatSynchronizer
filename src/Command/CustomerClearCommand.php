<?php

namespace App\Command;

use App\Contract\BackToFront\CustomerSynchronizerContract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomerClearCommand extends Command
{
    protected static $defaultName = 'customer:clear';

    /** @var CustomerSynchronizerContract $customerSynchronizer */
    protected $customerSynchronizer;

    /**
     * CustomerClearCommand constructor.
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
        $this->setDescription('Clear customers');
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
        $this->customerSynchronizer->clear();

        return 0;
    }
}