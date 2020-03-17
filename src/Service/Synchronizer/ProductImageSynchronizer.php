<?php

namespace App\Service\Synchronizer;

use App\Entity\Back\ProductPictures as ProductPicturesBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductImage as ProductImageFront;
use App\Other\Store;
use App\Service\FrontBackFileSystem\GetBackFileInterface;
use App\Service\FrontBackFileSystem\SaveFrontFileInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class ProductImageSynchronizer
{
    private $fileReader;
    private $fileWriter;
    private $store;
    private $backPath = '/products_pictures/';
    private $frontPath = '/date/products1/';

    public function __construct(GetBackFileInterface $fileReader, SaveFrontFileInterface $fileWriter, Store $store)
    {
        $this->fileReader = $fileReader;
        $this->fileWriter = $fileWriter;
        $this->store = $store;
        $this->backPath = '/products_pictures/';
        $this->frontPath = '/date/products1/';
    }

    public function clearFolder()
    {
        $path = $this->store->getFrontSitePath() . $this->frontPath;
        $this->fileWriter->clearFolder($path);
    }

    public function synchronizeImage(ProductPicturesBack $productPicturesBack, ProductFront $productFront, $number = 1)
    {
        $productPicturesFront = new ProductImageFront();
        $productPicturesFront->setProductId($productFront->getProductId());
        $productPicturesFront->setSortOrder($this->store->getDefaultSortOrder());
        $productPicturesFront->setImage('');

        $picture = $productPicturesBack->getFileName();
        $path = $this->backPath;

        if (null === $picture) {
            return $productPicturesFront;
        }

        $path = $this->store->getBackSitePath() . $path;
        $content = $this->fileReader->getFile($path . $picture);
        if (null === $content) {
            //@TODO Notify
            return $productPicturesFront;
        }

        $pathInfo = pathinfo($picture);

        $name = $productFront->getProductId() . '_' . $number . $pathInfo['extension'];
        $path = $this->frontPath . $name;

        try {
            $this->fileWriter->saveFile($this->store->getFrontSitePath() . $path, $content);
        } catch (UploadException $exception) {
            //@TODO Notify
            return $productPicturesFront;
        }

        $productPicturesFront->setImage($path);

        return $productPicturesFront;
    }
}