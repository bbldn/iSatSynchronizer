<?php

namespace App\Command;

use App\Contract\BackToFront\AttributeSynchronizerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AttributeSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'attribute:synchronize:all';

    /** @var AttributeSynchronizerInterface $attributeSynchronizer */
    protected $attributeSynchronizer;

    /**
     * AttributeSynchronizeCommand constructor.
     * @param AttributeSynchronizerInterface $attributeSynchronizer
     */
    public function __construct(AttributeSynchronizerInterface $attributeSynchronizer)
    {
        $this->attributeSynchronizer = $attributeSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure(): void
    {
        $this->setDescription('Synchronize attribute');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->attributeSynchronizer->load();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->attributeSynchronizer->synchronizeAll();

        return Command::SUCCESS;
    }
}