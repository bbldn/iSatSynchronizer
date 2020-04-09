<?php

namespace App\Entity\Back;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`photo`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\PhotoRepository")
 */
class Photo extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id_photo`")
     */
    private $idPhoto;

    /**
     * @ORM\Column(type="string", name="`name`", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", name="`productID`")
     */
    private $productId;

    /**
     * @ORM\Column(type="string", name="`small`")
     */
    private $small;

    /**
     * @ORM\Column(type="string", name="`big`")
     */
    private $big;

    /**
     * @ORM\Column(type="string", name="`hide`")
     */
    private $hide = 'hide';

    /**
     * @ORM\Column(type="integer", name="`pos`")
     */
    private $pos = 0;

    /**
     * @ORM\Column(type="integer", name="`id_catalog`")
     */
    private $idCatalog = 0;

    public function getIdPhoto(): ?int
    {
        return $this->idPhoto;
    }

    public function setIdPhoto(int $idPhoto): self
    {
        $this->idPhoto = $idPhoto;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getSmall(): ?string
    {
        return $this->small;
    }

    public function setSmall(string $small): self
    {
        $this->small = $small;

        return $this;
    }

    public function getBig(): ?string
    {
        return $this->big;
    }

    public function setBig(string $big): self
    {
        $this->big = $big;

        return $this;
    }

    public function getHide(): ?string
    {
        return $this->hide;
    }

    public function setHide(string $hide): self
    {
        $this->hide = $hide;

        return $this;
    }

    public function getPos(): ?int
    {
        return $this->pos;
    }

    public function setPos(int $pos): self
    {
        $this->pos = $pos;

        return $this;
    }

    public function getIdCatalog(): ?int
    {
        return $this->idCatalog;
    }

    public function setIdCatalog(int $idCatalog): self
    {
        $this->idCatalog = $idCatalog;

        return $this;
    }
}
