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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`photoID`")
     */
    protected $photoId;

    /**
     * @ORM\Column(type="integer", name="`productID`")
     */
    protected $productId;

    /**
     * @ORM\Column(type="string", name="`filename`", length=255, nullable=true)
     */
    protected $fileName;

    /**
     * @ORM\Column(type="string", name="`thumbnail`", length=255, nullable=true)
     */
    protected $thumbnail;

    /**
     * @ORM\Column(type="string", name="`enlarged`", length=255, nullable=true)
     */
    protected $enlarged;

    /**
     * @ORM\Column(type="string", name="`picture_vm`")
     */
    protected $pictureVm;

    /**
     * @ORM\Column(type="string", name="`thumbnail_vm`")
     */
    protected $thumbnailVm;

    /**
     * @ORM\Column(type="string", name="`enlarged_vm`")
     */
    protected $enlargedVm;

    public function getPhotoId(): ?int
    {
        return $this->photoId;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getEnlarged(): ?string
    {
        return $this->enlarged;
    }

    public function setEnlarged(?string $enlarged): self
    {
        $this->enlarged = $enlarged;

        return $this;
    }

    public function getPictureVm(): ?string
    {
        return $this->pictureVm;
    }

    public function setPictureVm(string $pictureVm): self
    {
        $this->pictureVm = $pictureVm;

        return $this;
    }

    public function getThumbnailVm(): ?string
    {
        return $this->thumbnailVm;
    }

    public function setThumbnailVm(string $thumbnailVm): self
    {
        $this->thumbnailVm = $thumbnailVm;

        return $this;
    }

    public function getEnlargedVm(): ?string
    {
        return $this->enlargedVm;
    }

    public function setEnlargedVm(string $enlargedVm): self
    {
        $this->enlargedVm = $enlargedVm;

        return $this;
    }
}
