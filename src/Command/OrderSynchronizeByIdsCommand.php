<?php

namespace App\Command;

use App\Contract\BackToFront\OrderSynchronizerInterface as OrderBackToFrontSynchronizerContract;
use App\Contract\FrontToBack\OrderSynchronizerInterface as OrderFrontToBackSynchronizerContract;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderSynchronizeByIdsCommand extends Command
{
    protected static $defaultName = 'order:synchronize:by-ids';

    /** @var OrderFrontToBackSynchronizerContract $orderFrontToBackSynchronizer */
    protected $orderFrontToBackSynchronizer;

    /** @var OrderBackToFrontSynchronizerContract $orderBackToFrontSynchronizer */
    protected $orderBackToFrontSynchronizer;

    /**
     * OrderSynchronizeByIdsCommand constructor.
     * @param OrderFrontToBackSynchronizerContract $orderFrontToBackSynchronizer
     * @param OrderBackToFrontSynchronizerContract $orderBackToFrontSynchronizer
     */
    public function __construct(
        OrderFrontToBackSynchronizerContract $orderFrontToBackSynchronizer,
        OrderBackToFrontSynchronizerContract $orderBackToFrontSynchronizer
    )
    {
        $this->orderFrontToBackSynchronizer = $orderFrontToBackSynchronizer;
        $this->orderBackToFrontSynchronizer = $orderBackToFrontSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Order one synchronize');
        $this->addArgument('direction', InputArgument::REQUIRED, 'Direction');
        $this->addArgument('ids', InputArgument::REQUIRED, 'Reset image');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->orderFrontToBackSynchronizer->load();
        $this->orderBackToFrontSynchronizer->load();
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
            $ids = $this->getIdsFromInput($input);
            $this->orderFrontToBackSynchronizer->synchronizeByIds($ids);
        } elseif ('backToFront' === $direction) {
            $ids = $this->getIdsFromInput($input);
            $this->orderBackToFrontSynchronizer->synchronizeByIds($ids);
        } else {
            throw new InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return Command::SUCCESS;
    }
}