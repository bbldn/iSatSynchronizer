<?php

namespace App\Command;

use App\Exception\CustomerFrontNotFoundException;
use App\Service\Synchronizer\FrontToBack\CustomerSynchronizer as CustomerFrontToBackSynchronize;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomerSynchronizeOneCommand extends Command
{
    protected static $defaultName = 'customer:synchronize:one';

    /** @var CustomerFrontToBackSynchronize $customerSynchronizer */
    protected $customerSynchronizer;

    /**
     * CustomerSynchronizeOneCommand constructor.
     * @param CustomerFrontToBackSynchronize $customerFrontToBackSynchronizer
     */
    public function __construct(CustomerFrontToBackSynchronize $customerFrontToBackSynchronizer)
    {
        $this->customerSynchronizer = $customerFrontToBackSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize customers');
        $this->addArgument('id', InputArgument::REQUIRED, 'idCustomer');
        $this->addArgument('password', InputArgument::REQUIRED, 'passwordCustomer');
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
     * @throws CustomerFrontNotFoundException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $id = $this->parseId($input);
        $password = $input->getArgument('password');
        $this->customerSynchronizer->synchronizeOne((int)$id, $password);

        return 0;
    }
}