<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\AttributeSynchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AttributeSynchronizeAllCommand extends Command
{
    protected static $defaultName = 'attribute:synchronize:all';

    /** @var AttributeSynchronizer $attributeSynchronize */
    protected $attributeSynchronize;

    /**
     * AttributeSynchronizeCommand constructor.
     * @param AttributeSynchronizer $attributeSynchronize
     */
    public function __construct(AttributeSynchronizer $attributeSynchronize)
    {
        $this->attributeSynchronize = $attributeSynchronize;
        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this->setDescription('Synchronize attribute');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->attributeSynchronize->synchronizeAll();

        return 0;
    }
}