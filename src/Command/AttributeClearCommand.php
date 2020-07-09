<?php

namespace App\Command;

use App\Contract\BackToFront\AttributeSynchronizerContract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AttributeClearCommand extends Command
{
    protected static $defaultName = 'attribute:clear';

    /** @var AttributeSynchronizerContract $attributeSynchronizer */
    protected $attributeSynchronizer;

    /**
     * AttributeClearCommand constructor.
     * @param AttributeSynchronizerContract $attributeSynchronizer
     */
    public function __construct(AttributeSynchronizerContract $attributeSynchronizer)
    {
        $this->attributeSynchronizer = $attributeSynchronizer;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure(): void
    {
        $this->setDescription('Clear products');
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
        $this->attributeSynchronizer->clear();

        return 0;
    }
}