<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\CustomerSynchronizer as CustomerBackToFrontSynchronize;
use App\Service\Synchronizer\FrontToBack\CustomerSynchronizer as CustomerFrontToBackSynchronize;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomerSynchronizeByIdsCommand extends Command
{
    protected static $defaultName = 'customer:synchronize:by-ids';

    /** @var CustomerBackToFrontSynchronize $customerBackToFrontSynchronize */
    protected $customerBackToFrontSynchronize;

    /** @var CustomerFrontToBackSynchronize $customerFrontToBackSynchronize */
    protected $customerFrontToBackSynchronize;

    /**
     * CustomerSynchronizeByIdsCommand constructor.
     * @param CustomerBackToFrontSynchronize $customerBackToFrontSynchronize
     * @param CustomerFrontToBackSynchronize $customerFrontToBackSynchronize
     */
    public function __construct(
        CustomerBackToFrontSynchronize $customerBackToFrontSynchronize,
        CustomerFrontToBackSynchronize $customerFrontToBackSynchronize
    )
    {
        $this->customerBackToFrontSynchronize = $customerBackToFrontSynchronize;
        $this->customerFrontToBackSynchronize = $customerFrontToBackSynchronize;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize customers');
        $this->addArgument('direction', InputArgument::REQUIRED, 'Direction');
        $this->addArgument('ids', InputArgument::REQUIRED, 'idCustomer');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $direction = $input->getArgument('direction');

        if ('frontToBack' === $direction) {
            $ids = $this->testIds($input);
            $this->customerFrontToBackSynchronize->synchronizeByIds($ids);
        } elseif ('backToFront' === $direction) {
            $ids = $this->testIds($input);
            $this->customerBackToFrontSynchronize->synchronizeByIds($ids);
        } else {
            throw new InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return 0;
    }
}