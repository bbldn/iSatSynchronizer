<?php

namespace App\Entity\Back;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_product_pictures`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\ProductPicturesRepository")
 */
class ProductPictures
{
    /**
     * @var int|null $photoId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`photoID`")
     */
    protected $photoId;

    /**
     * @var int|null $productId
     * @ORM\Column(type="integer", name="`productID`")
     */
    protected $productId;

    /**
     * @var string|null $fileName
     * @ORM\Column(type="string", name="`filename`", length=255, nullable=true)
     */
    protected $fileName;

    /**
     * @var string|null $thumbnail
     * @ORM\Column(type="string", name="`thumbnail`", length=255, nullable=true)
     */
    protected $thumbnail;

    /**
     * @var string|null $enlarged
     * @ORM\Column(type="string", name="`enlarged`", length=255, nullable=true)
     */
    protected $enlarged;

    /**
     * @var string|null $pictureVm
     * @ORM\Column(type="string", name="`picture_vm`")
     */
    protected $pictureVm;

    /**
     * @var string|null $thumbnailVm
     * @ORM\Column(type="string", name="`thumbnail_vm`")
     */
    protected $thumbnailVm;

    /**
     * @var string|null $enlargedVm
     * @ORM\Column(type="string", name="`enlarged_vm`")
     */
    protected $enlargedVm;

    /**
     * @return int|null
     */
    public function getPhotoId(): ?int
    {
        return $this->photoId;
    }

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return ProductPictures
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param string|null $fileName
     * @return ProductPictures
     */
    public function setFileName(?string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    /**
     * @param string|null $thumbnail
     * @return ProductPictures
     */
    public function setThumbnail(?string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEnlarged(): ?string
    {
        return $this->enlarged;
    }

    /**
     * @param string|null $enlarged
     * @return ProductPictures
     */
    public function setEnlarged(?string $enlarged): self
    {
        $this->enlarged = $enlarged;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPictureVm(): ?string
    {
        return $this->pictureVm;
    }

    /**
     * @param string $pictureVm
     * @return ProductPictures
     */
    public function setPictureVm(string $pictureVm): self
    {
        $this->pictureVm = $pictureVm;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getThumbnailVm(): ?string
    {
        return $this->thumbnailVm;
    }

    /**
     * @param string $thumbnailVm
     * @return ProductPictures
     */
    public function setThumbnailVm(string $thumbnailVm): self
    {
        $this->thumbnailVm = $thumbnailVm;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEnlargedVm(): ?string
    {
        return $this->enlargedVm;
    }

    /**
     * @param string $enlargedVm
     * @return ProductPictures
     */
    public function setEnlargedVm(string $enlargedVm): self
    {
        $this->enlargedVm = $enlargedVm;

        return $this;
    }
}
