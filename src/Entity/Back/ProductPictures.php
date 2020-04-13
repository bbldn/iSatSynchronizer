<?php

namespace App\Entity\Back;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`SS_product_pictures`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\ProductPicturesRepository")
 */
class ProductPictures extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`photoID`")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="`productID`")
     */
    private $productId;

    /**
     * @ORM\Column(type="string", name="`filename`", length=255, nullable=true)
     */
    private $fileName;

    /**
     * @ORM\Column(type="string", name="`thumbnail`", length=255, nullable=true)
     */
    private $thumbnail;

    /**
     * @ORM\Column(type="string", name="`enlarged`", length=255, nullable=true)
     */
    private $enlarged;

    /**
     * @ORM\Column(type="string", name="`picture_vm`")
     */
    private $pictureVm;

    /**
     * @ORM\Column(type="string", name="`thumbnail_vm`")
     */
    private $thumbnailVm;

    /**
     * @ORM\Column(type="string", name="`enlarged_vm`")
     */
    private $enlargedVm;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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
