<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Photo as PhotoBack;
use App\Entity\Back\ProductPictures as ProductPicturesBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductImage as ProductImageFront;
use App\Helper\Back\Store as StoreBack;
use App\Helper\ExceptionFormatter;
use App\Helper\Filler;
use App\Helper\Front\Store as StoreFront;
use App\Service\FrontBackFileSystem\GetBackFileInterface;
use App\Service\FrontBackFileSystem\SaveFrontFileInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class ProductImageSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var StoreBack $storeBack */
    protected $storeBack;

    /** @var GetBackFileInterface $fileReader */
    protected $fileReader;

    /** @var SaveFrontFileInterface $fileWriter */
    protected $fileWriter;

    /** @var array $backPath */
    protected $backPath = ['/products_pictures/', '/gal/files/'];

    /** @var string $frontPath */
    protected $frontPath = '/date/products/';

    /**
     * ProductImageSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param StoreFront $storeFront
     * @param StoreBack $storeBack
     * @param GetBackFileInterface $fileReader
     * @param SaveFrontFileInterface $fileWriter
     * @param array $productImageBackPath
     * @param string $productImageFrontPath
     */
    public function __construct(
        LoggerInterface $logger,
        StoreFront $storeFront,
        StoreBack $storeBack,
        GetBackFileInterface $fileReader,
        SaveFrontFileInterface $fileWriter,
        array $productImageBackPath,
        string $productImageFrontPath
    )
    {
        $this->logger = $logger;
        $this->storeFront = $storeFront;
        $this->storeBack = $storeBack;
        $this->fileReader = $fileReader;
        $this->fileWriter = $fileWriter;
        $this->backPath = $productImageBackPath;
        $this->frontPath = $productImageFrontPath;
    }

    /**
     *
     */
    public function clearFolder(): void
    {
        $path = $this->storeFront->getSitePath() . $this->frontPath;
        $this->fileWriter->clearFolder($path);
    }

    /**
     * @param ProductPicturesBack $productPicturesBack
     * @param ProductFront $productFront
     * @param int $number
     * @return ProductImageFront
     */
    public function synchronizeProductImage(
        ProductPicturesBack $productPicturesBack,
        ProductFront $productFront,
        $number = 1
    ): ProductImageFront
    {
        return $this->synchronize($productPicturesBack->getFileName(), $productFront, $number);
    }

    /**
     * @param string $picture
     * @param ProductFront $productFront
     * @param int $number
     * @return ProductImageFront
     */
    protected function synchronize(string $picture, ProductFront $productFront, $number = 1): ProductImageFront
    {
        $productPicturesFront = new ProductImageFront();
        $productPicturesFront->setProductId($productFront->getProductId());
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
                $this->logger->error(
                    ExceptionFormatter::f('Image not found')
                );

                return $productPicturesFront;
            }
        }

        $pathInfo = pathinfo($picture);

        $name = $productFront->getProductId() . '_' . $number . '.' . mb_strtolower($pathInfo['extension']);
        $path = $this->frontPath . $name;

        try {
            $this->fileWriter->saveFile($this->storeFront->getSitePath() . $path, $content);
        } catch (UploadException $exception) {
            $this->logger->error(
                ExceptionFormatter::f('Error image save')
            );

            return $productPicturesFront;
        }

        $productPicturesFront->setImage(str_replace('/image', '', $path));

        return $productPicturesFront;
    }

    /**
     * @param PhotoBack $photoBack
     * @param ProductFront $productFront
     * @param int $number
     * @return ProductImageFront
     */
    public function synchronizePhoto(PhotoBack $photoBack, ProductFront $productFront, $number = 1): ProductImageFront
    {
        return $this->synchronize($photoBack->getBig(), $productFront, $number);
    }
}