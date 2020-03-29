<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\CustomerSynchronizer as CustomerBackToFrontSynchronize;
use App\Service\Synchronizer\FrontToBack\CustomerSynchronizer as CustomerFrontToBackSynchronize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomerClearCommand extends Command
{
    protected static $defaultName = 'customer:clear';
    private $customerBackToFrontSynchronize;
    private $customerFrontToBackSynchronize;

    public function __construct(
        CustomerBackToFrontSynchronize $customerBackToFrontSynchronize,
        CustomerFrontToBackSynchronize $customerFrontToBackSynchronize
    )
    {
        $this->customerBackToFrontSynchronize = $customerBackToFrontSynchronize;
        $this->customerFrontToBackSynchronize = $customerFrontToBackSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Clear customers');
        $this->addArgument('direction', InputArgument::REQUIRED, 'Direction');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $direction = $input->getArgument('direction');

        if ('frontToBack' === $direction) {
            $this->customerFrontToBackSynchronize;
        } elseif ('backToFront' === $direction) {
            $this->customerBackToFrontSynchronize->clear();
        } else {
            throw new \InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return 0;
    }
}