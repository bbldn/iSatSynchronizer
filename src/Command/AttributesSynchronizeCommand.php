<?php

namespace App\Command;

use App\Service\Synchronizer\AttributeSynchronize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AttributesSynchronizeCommand extends Command
{
    protected static $defaultName = 'attributes:synchronize';
    private $attributeSynchronize;

    public function __construct(AttributeSynchronize $attributeSynchronize)
    {
        $this->attributeSynchronize = $attributeSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Synchronize products');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->attributeSynchronize->synchronize();

        return 0;
    }
}