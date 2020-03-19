<?php

namespace App\Command;

use App\Service\Synchronizer\CategorySynchronize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategoriesClearCommand extends Command
{
    protected static $defaultName = 'categories:clear';
    private $categorySynchronize;

    public function __construct(CategorySynchronize $categorySynchronize)
    {
        $this->categorySynchronize = $categorySynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Clear categories');
        $this->addArgument('removeImage', InputArgument::OPTIONAL, 'Remove image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $removeImage = $input->hasArgument('removeImage');
        $this->categorySynchronize->clear($removeImage);

        return 0;
    }
}
