<?php

namespace App\Command;

use App\Contract\BackToFront\OrderSynchronizerInterface as OrderBackToFrontSynchronizerContract;
use App\Contract\FrontToBack\OrderSynchronizerInterface as OrderFrontToBackSynchronizerContract;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'order:synchronize:all';

    /** @var OrderFrontToBackSynchronizerContract $orderFrontToBackSynchronizer */
    protected $orderFrontToBackSynchronizer;

    /** @var OrderBackToFrontSynchronizerContract $orderBackToFrontSynchronizer */
    protected $orderBackToFrontSynchronizer;

    /**
     * OrderSynchronizeAllCommand constructor.
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
    protected function configure(): void
    {
        $this->setDescription('Synchronize orders');
        $this->addArgument('direction', InputArgument::REQUIRED, 'Direction');
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
            $this->orderFrontToBackSynchronizer->synchronizeAll();
        } elseif ('backToFront' === $direction) {
            $this->orderBackToFrontSynchronizer->synchronizeAll();
        } else {
            throw new InvalidArgumentException("Invalidate direction: {$direction}");
        }

        return Command::SUCCESS;
    }
}