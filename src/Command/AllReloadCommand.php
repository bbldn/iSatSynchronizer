<?php

namespace App\Command;

use App\Service\Synchronizer\BackToFront\AttributeSynchronizer;
use App\Service\Synchronizer\BackToFront\CategorySynchronizer;
use App\Service\Synchronizer\BackToFront\ProductSynchronizer;
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

    public function __construct(
        AttributeSynchronizer $attributeSynchronize,
        CategorySynchronizer $categorySynchronize,
        ProductSynchronizer $productSynchronize
    )
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