<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Photo as PhotoBack;
use App\Entity\Back\ProductPictures as ProductPicturesBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductImage;
use App\Entity\Front\ProductImage as ProductImageFront;
use App\Helper\Back\Store as StoreBack;
use App\Helper\ExceptionFormatter;
use App\Helper\Front\Store as StoreFront;
use App\Repository\Front\ProductImageRepository as ProductImageFrontRepository;
use App\Service\FrontBackFileSystem\GetBackFileInterface;
use App\Service\FrontBackFileSystem\SaveFrontFileInterface;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class ProductImageSynchronizer extends BackToFrontSynchronizer
{
    /** @var LoggerInterface $logger */
    protected $logger;

    /** @var StoreFront $storeFront */
    protected $storeFront;

    /** @var StoreBack $storeBack */
    protected $storeBack;

    /** @var ProductImageFrontRepository $productImageFrontRepository */
    protected $productImageFrontRepository;

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
     * @param ProductImageFrontRepository $productImageFrontRepository
     * @param GetBackFileInterface $fileReader
     * @param SaveFrontFileInterface $fileWriter
     * @param array $productImageBackPath
     * @param string $productImageFrontPath
     */
    public function __construct(
        LoggerInterface $logger,
        StoreFront $storeFront,
        StoreBack $storeBack,
        ProductImageFrontRepository $productImageFrontRepository,
        GetBackFileInterface $fileReader,
        SaveFrontFileInterface $fileWriter,
        array $productImageBackPath,
        string $productImageFrontPath
    )
    {
        $this->logger = $logger;
        $this->storeFront = $storeFront;
        $this->storeBack = $storeBack;
        $this->productImageFrontRepository = $productImageFrontRepository;
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
        $path = $this->storeFront->getDefaultSitePath() . $this->frontPath;
        $this->fileWriter->clearFolder($path);
    }

    /**
     * @param ProductPicturesBack $productPicturesBack
     * @param ProductFront $productFront
     * @param int $number
     * @return ProductImageFront|null
     */
    public function synchronizeProductImage(
        ProductPicturesBack $productPicturesBack,
        ProductFront $productFront,
        $number = 1
    ): ?ProductImageFront
    {
        return $this->synchronize($productPicturesBack->getEnlargedVm(), $productFront, $number);
    }

    /**
     * @param int $productId
     * @param string $imagePath
     * @return ProductImageFront
     */
    protected function getProductImageFrontByProductIdAndImagePath(int $productId, string $imagePath): ProductImageFront
    {
        $productImage = $this->productImageFrontRepository->findOneByProductIdAndImagePath($productId, $imagePath);

        if (null === $productImage) {
            $productImage = new ProductImageFront();
        }

        return $productImage;
    }

    /**
     * @param string $picture
     * @param ProductFront $productFront
     * @param int $number
     * @return ProductImageFront|null
     */
    protected function synchronize(string $picture, ProductFront $productFront, $number = 1): ?ProductImageFront
    {
        if (null === $picture) {
            return null;
        }

        $path = $this->storeBack->getDefaultSitePath() . $this->backPath[0];
        $content = $this->fileReader->getFile($path . $picture);
        if (null === $content) {
            $path = $this->storeBack->getDefaultSitePath() . $this->backPath[1];
            $content = $this->fileReader->getFile($path . $picture);
            if (null === $content) {
                return null;
            }
        }

        $pathInfo = pathinfo($picture);

        $name = $productFront->getProductId() . '_' . $number . '.' . mb_strtolower($pathInfo['extension']);
        $path = $this->frontPath . $name;
        $bdFileName = str_replace('/image/', '', $path);

        $productPicturesFront = $this->getProductImageFrontByProductIdAndImagePath(
            $productFront->getProductId(),
            $bdFileName
        );
        $productPicturesFront->setProductId($productFront->getProductId());
        $productPicturesFront->setSortOrder($this->storeFront->getDefaultSortOrder());

        try {
            $this->fileWriter->saveFile($this->storeFront->getDefaultSitePath() . $path, $content);
        } catch (UploadException $exception) {
            $this->logger->error(ExceptionFormatter::f('Error image save'));

            return null;
        }

        $productPicturesFront->setImage($bdFileName);
        $this->productImageFrontRepository->persistAndFlush($productPicturesFront);

        return $productPicturesFront;
    }

    /**
     * @param PhotoBack $photoBack
     * @param ProductFront $productFront
     * @param int $number
     * @return ProductImageFront|null
     */
    public function synchronizePhoto(PhotoBack $photoBack, ProductFront $productFront, $number = 1): ?ProductImageFront
    {
        $pathInfo = pathinfo($photoBack->getBig());

        return $this->synchronize(md5($photoBack->getBig()). '.' . $pathInfo['extension'], $productFront, $number);
    }
}