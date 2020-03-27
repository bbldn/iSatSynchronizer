<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\AttributeSynchronize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AttributeClearCommand extends Command
{
    protected static $defaultName = 'attribute:clear';
    private $attributeSynchronize;

    public function __construct(AttributeSynchronize $attributeSynchronize)
    {
        $this->attributeSynchronize = $attributeSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Clear products');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->attributeSynchronize->clear();

        return 0;
    }
}