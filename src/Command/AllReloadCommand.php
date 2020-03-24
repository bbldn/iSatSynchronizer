<?php

namespace App\Command;

use App\Service\Synchronizer\AttributeSynchronize;
use App\Service\Synchronizer\CategorySynchronize;
use App\Service\Synchronizer\ProductSynchronize;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AllReloadCommand extends Command
{
    protected static $defaultName = 'all:reload';
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
        $this->setDescription('Reload all');
        $this->addArgument('reloadImage', InputArgument::OPTIONAL, 'Reload image');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $reloadImage = $input->getArgument('reloadImage') !== null;
        $this->categorySynchronize->reload($reloadImage);
        $this->attributeSynchronize->reload();
        $this->productSynchronize->reload($reloadImage);

        return 0;
    }
}