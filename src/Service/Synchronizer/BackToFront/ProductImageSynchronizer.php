<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Entity\Back\Photo as PhotoBack;
use App\Entity\Back\ProductPictures as ProductPicturesBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductImage as ProductImageFront;
use App\Other\Back\Store as StoreBack;
use App\Other\Filler;
use App\Other\Front\Store as StoreFront;
use App\Service\FrontBackFileSystem\GetBackFileInterface;
use App\Service\FrontBackFileSystem\SaveFrontFileInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class ProductImageSynchronizer
{
    private $storeFront;
    private $storeBack;
    private $fileReader;
    private $fileWriter;
    private $backPath = ['/products_pictures/', '/gal/files/'];
    private $frontPath = '/date/products/';

    public function __construct(
        StoreFront $storeFront,
        StoreBack $storeBack,
        GetBackFileInterface $fileReader,
        SaveFrontFileInterface $fileWriter,
        array $productImageBackPath,
        string $productImageFrontPath
    )
    {
        $this->storeFront = $storeFront;
        $this->storeBack = $storeBack;
        $this->fileReader = $fileReader;
        $this->fileWriter = $fileWriter;
        $this->backPath = $productImageBackPath;
        $this->frontPath = $productImageFrontPath;
    }

    public function clearFolder(): void
    {
        $path = $this->storeFront->getSitePath() . $this->frontPath;
        $this->fileWriter->clearFolder($path);
    }

    public function synchronizeProductImage(
        ProductPicturesBack $productPicturesBack,
        ProductFront $productFront,
        $number = 1
    ): ProductImageFront
    {
        return $this->synchronize($productPicturesBack->getFileName(), $productFront, $number);
    }

    public function synchronizePhoto(PhotoBack $photoBack, ProductFront $productFront, $number = 1): ProductImageFront
    {
        return $this->synchronize($photoBack->getBig(), $productFront, $number);
    }

    protected function synchronize(string $picture, ProductFront $productFront, $number = 1): ProductImageFront
    {
        $productPicturesFront = new ProductImageFront();
        $productPicturesFront->setProductId($productFront->getId());
        $productPicturesFront->setSortOrder($this->storeFront->getDefaultSortOrder());
        $productPicturesFront->setImage(Filler::securityString(null));

        if (null === $picture) {
            return $productPicturesFront;
        }

        $path = $this->storeBack->getSitePath() . $this->backPath[0];
        $content = $this->fileReader->getFile($path . $picture);
        if (null === $content) {
            $path = $this->storeBack->getSitePath() . $this->backPath[1];
            $content = $this->fileReader->getFile($path . $picture);
            if (null === $content) {
                //@TODO Notify
                return $productPicturesFront;
            }
        }

        $pathInfo = pathinfo($picture);

        $name = $productFront->getId() . '_' . $number . '.' . mb_strtolower($pathInfo['extension']);
        $path = $this->frontPath . $name;

        try {
            $this->fileWriter->saveFile($this->storeFront->getSitePath() . $path, $content);
        } catch (UploadException $exception) {
            //@TODO Notify
            return $productPicturesFront;
        }

        $productPicturesFront->setImage(str_replace('/image', '', $path));

        return $productPicturesFront;
    }
}