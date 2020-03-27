<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\Photo as PhotoBack;
use App\Entity\Back\ProductPictures as ProductPicturesBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductImage as ProductImageFront;
use App\Other\Fillers\Filler;
use App\Other\Store;
use App\Service\FrontBackFileSystem\GetBackFileInterface;
use App\Service\FrontBackFileSystem\SaveFrontFileInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class ProductImageSynchronizer
{
    private $fileReader;
    private $fileWriter;
    private $store;
    private $backPath = ['/products_pictures/', '/gal/files/'];
    private $frontPath = '/date/products/';

    public function __construct(GetBackFileInterface $fileReader,
                                SaveFrontFileInterface $fileWriter,
                                Store $store,
                                array $productImageBackPath,
                                string $productImageFrontPath)
    {
        $this->fileReader = $fileReader;
        $this->fileWriter = $fileWriter;
        $this->store = $store;
        $this->backPath = $productImageBackPath;
        $this->frontPath = $productImageFrontPath;
    }

    public function clearFolder()
    {
        $path = $this->store->getFrontSitePath() . $this->frontPath;
        $this->fileWriter->clearFolder($path);
    }

    public function synchronizeProductImage(ProductPicturesBack $productPicturesBack, ProductFront $productFront, $number = 1)
    {
        return $this->synchronize($productPicturesBack->getFileName(), $productFront, $number);
    }

    public function synchronizePhoto(PhotoBack $photoBack, ProductFront $productFront, $number = 1)
    {
        return $this->synchronize($photoBack->getBig(), $productFront, $number);
    }

    protected function synchronize(string $picture, ProductFront $productFront, $number = 1)
    {
        $productPicturesFront = new ProductImageFront();
        $productPicturesFront->setProductId($productFront->getProductId());
        $productPicturesFront->setSortOrder($this->store->getDefaultSortOrder());
        $productPicturesFront->setImage(Filler::securityString(null));

        if (null === $picture) {
            return $productPicturesFront;
        }

        $path = $this->store->getBackSitePath() . $this->backPath[0];
        $content = $this->fileReader->getFile($path . $picture);
        if (null === $content) {
            $path = $this->store->getBackSitePath() . $this->backPath[1];
            $content = $this->fileReader->getFile($path . $picture);
            if (null === $content) {
                //@TODO Notify
                return $productPicturesFront;
            }
        }

        $pathInfo = pathinfo($picture);

        $name = $productFront->getProductId() . '_' . $number . '.' . mb_strtolower($pathInfo['extension']);
        $path = $this->frontPath . $name;

        try {
            $this->fileWriter->saveFile($this->store->getFrontSitePath() . $path, $content);
        } catch (UploadException $exception) {
            //@TODO Notify
            return $productPicturesFront;
        }

        $productPicturesFront->setImage(str_replace('/image', '', $path));

        return $productPicturesFront;
    }
}