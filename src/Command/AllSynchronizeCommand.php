<?php

namespace App\Command;

use App\Service\Synchronizer\AttributeSynchronize;
use App\Service\Synchronizer\CategorySynchronize;
use App\Service\Synchronizer\ProductSynchronize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AllSynchronizeCommand extends Command
{
    protected static $defaultName = 'all:synchronize';
    private $attributeSynchronize;
    private $categorySynchronize;
    private $productSynchronize;

    public function __construct(AttributeSynchronize $attributeSynchronize,
                                CategorySynchronize $categorySynchronize,
                                ProductSynchronize $productSynchronize)
    {
        $this->attributeSynchronize = $attributeSynchronize;
        $this->categorySynchronize = $categorySynchronize;
        $this->productSynchronize = $productSynchronize;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDescription('Synchronize all');
        $this->addArgument('resetImage', InputArgument::OPTIONAL, 'Reset image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $resetImage = $input->hasArgument('resetImage');
        $this->categorySynchronize->synchronize($resetImage);
        $this->attributeSynchronize->synchronize();
        $this->productSynchronize->synchronize($resetImage);

        return 0;
    }
}