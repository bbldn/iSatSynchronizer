<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Back\Photo as PhotoBack;
use App\Entity\Back\Product as ProductBack;
use App\Entity\Back\ProductPictures as ProductPicturesBack;
use App\Entity\Front\Product as ProductFront;
use App\Entity\Front\ProductImage;
use App\Entity\Front\ProductImage as ProductImageFront;
use App\Helper\Back\Store as StoreBack;
use App\Helper\ExceptionFormatter;
use App\Helper\Front\Store as StoreFront;
use App\Repository\Back\PhotoRepository as PhotoBackRepository;
use App\Repository\Back\ProductPicturesRepository as ProductPicturesBackRepository;
use App\Repository\Front\ProductImageRepository as ProductImageFrontRepository;
use App\Repository\Front\ProductRepository as ProductFrontRepository;
use App\Service\FrontBackFileSystem\GetBackFileInterface;
use App\Service\FrontBackFileSystem\SaveFrontFileInterface;
use App\Service\Synchronizer\BackToFront\BackToFrontSynchronizer;
use Psr\Log\LoggerInterface;
use Throwable;

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

    /** @var PhotoBackRepository $photoBackRepository */
    protected $photoBackRepository;

    /** @var ProductPicturesBackRepository $productPicturesBackRepository */
    protected $productPicturesBackRepository;

    /** @var ProductFrontRepository $productFrontRepository */
    protected $productFrontRepository;

    /** @var GetBackFileInterface $fileReader */
    protected $fileReader;

    /** @var SaveFrontFileInterface $fileWriter */
    protected $fileWriter;

    /** @var string[] $backPath */
    protected $backPath = ['/products_pictures/', '/gal/files/'];

    /** @var string $frontPath */
    protected $frontPath = '/date/products/';

    /** @var string $defaultImagePath */
    protected $defaultImagePath = null;

    /**
     * ProductImageSynchronizer constructor.
     * @param LoggerInterface $logger
     * @param StoreFront $storeFront
     * @param StoreBack $storeBack
     * @param ProductImageFrontRepository $productImageFrontRepository
     * @param PhotoBackRepository $photoBackRepository
     * @param ProductPicturesBackRepository $productPicturesBackRepository
     * @param ProductFrontRepository $productFrontRepository
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
        PhotoBackRepository $photoBackRepository,
        ProductPicturesBackRepository $productPicturesBackRepository,
        ProductFrontRepository $productFrontRepository,
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
        $this->photoBackRepository = $photoBackRepository;
        $this->productPicturesBackRepository = $productPicturesBackRepository;
        $this->productFrontRepository = $productFrontRepository;
        $this->fileReader = $fileReader;
        $this->fileWriter = $fileWriter;
        $this->backPath = $productImageBackPath;
        $this->frontPath = $productImageFrontPath;
    }

    /**
     *
     */
    protected function clearFolder(): void
    {
        try {
            $this->fileWriter->clearFolder($this->frontPath);
        } catch (Throwable $e) {
            $error = "Error clear folder: {$e->getMessage()}";
            $this->logger->error(ExceptionFormatter::f($error));
        }
    }

    /**
     * @param ProductPicturesBack $productPicturesBack
     * @param ProductFront $productFront
     * @param int $number
     * @return ProductImageFront|null
     */
    protected function synchronizeProductImage(
        ProductPicturesBack $productPicturesBack,
        ProductFront $productFront,
        int $number = 1
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
    protected function synchronize(string $picture, ProductFront $productFront, int $number = 1): ?ProductImageFront
    {
        if (null === $picture) {
            return null;
        }

        $path = $this->storeBack->getDefaultSitePath() . $this->backPath[0];
        $content = $this->getFile($path . $picture);
        if (null === $content) {
            $path = $this->storeBack->getDefaultSitePath() . $this->backPath[1];
            $content = $this->getFile($path . $picture);
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
            $this->fileWriter->saveFile($path, $content);
        } catch (Throwable $e) {
            $message = "Error image save: {$e->getMessage()}";
            $this->logger->error(ExceptionFormatter::f($message));

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
    protected function synchronizePhoto(
        PhotoBack $photoBack,
        ProductFront $productFront,
        int $number = 1
    ): ?ProductImageFront
    {
        $pathInfo = pathinfo($photoBack->getBig());
        $picture = md5($photoBack->getBig()) . '.' . $pathInfo['extension'];

        return $this->synchronize($picture, $productFront, $number);
    }

    /**
     * @param string $path
     * @return string|null
     */
    protected function getFile(string $path): ?string
    {
        try {
            return $this->fileReader->getFile($path);
        } catch (Throwable $e) {
            $error = "Error getting path: {$path}. Error: {$e->getMessage()}";
            $this->logger->error(ExceptionFormatter::f($error));

            return null;
        }
    }

    protected function synchronizeImage(ProductBack $productBack, ProductFront $productFront): void
    {
        $productFront->setImage($this->defaultImagePath);
        $productBackImages = $this->productPicturesBackRepository->findByProductBackId($productBack->getProductId());
        foreach ($productBackImages as $key => $productBackImage) {
            $productFrontImage = $this->synchronizeProductImage(
                $productBackImage,
                $productFront,
                $key + 1
            );

            if (null === $productFrontImage) {
                continue;
            }

            if ($productFront->getImage() === $this->defaultImagePath) {
                $productFront->setImage($productFrontImage->getImage());
            }

            if ($productFront->getImage() === $productFrontImage->getImage()) {
                $this->productImageFrontRepository->remove($productFrontImage);
            }
        }

        $count = count($productBackImages) + 1;
        $photosBack = $this->photoBackRepository->findByProductBackId($productBack->getProductId());
        foreach ($photosBack as $key => $photoBack) {
            $productFrontImage = $this->synchronizePhoto(
                $photoBack,
                $productFront,
                $key + $count
            );

            if (null === $productFrontImage) {
                continue;
            }

            if ($productFront->getImage() === $this->defaultImagePath) {
                $productFront->setImage($productFrontImage->getImage());
            }

            if ($productFront->getImage() === $productFrontImage->getImage()) {
                $this->productImageFrontRepository->remove($productFrontImage);
            }
        }

        $this->productFrontRepository->persistAndFlush($productFront);
    }
}