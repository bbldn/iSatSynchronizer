<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\CustomerSynchronizer as CustomerBackToFrontSynchronize;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomerSynchronizeByIdsCommand extends Command
{
    protected static $defaultName = 'customer:synchronize:by-ids';

    /** @var CustomerBackToFrontSynchronize $customerBackToFrontSynchronize */
    protected $customerBackToFrontSynchronize;

    /**
     * CustomerSynchronizeByIdsCommand constructor.
     * @param CustomerBackToFrontSynchronize $customerBackToFrontSynchronize
     */
    public function __construct(CustomerBackToFrontSynchronize $customerBackToFrontSynchronize)
    {
        $this->customerBackToFrontSynchronize = $customerBackToFrontSynchronize;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize customers');
        $this->addArgument('ids', InputArgument::REQUIRED, 'idCustomer');
    }

    /**
     *
     */
    protected function load(): void
    {
        $this->customerBackToFrontSynchronize->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        parent::execute($input, $output);
        $ids = $this->testIds($input);
        $this->customerBackToFrontSynchronize->synchronizeByIds($ids);

        return 0;
    }
}