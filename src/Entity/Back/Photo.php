<?php

namespace App\Entity\Back;

use App\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`photo`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\PhotoRepository")
 */
class Photo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id_photo`")
     */
    protected $idPhoto;

    /**
     * @ORM\Column(type="string", name="`name`", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="integer", name="`productID`")
     */
    protected $productId;

    /**
     * @ORM\Column(type="string", name="`small`")
     */
    protected $small;

    /**
     * @ORM\Column(type="string", name="`big`")
     */
    protected $big;

    /**
     * @ORM\Column(type="string", name="`hide`")
     */
    protected $hide = 'hide';

    /**
     * @ORM\Column(type="integer", name="`pos`")
     */
    protected $pos = 0;

    /**
     * @ORM\Column(type="integer", name="`id_catalog`")
     */
    protected $idCatalog = 0;

    public function getIdPhoto(): ?int
    {
        return $this->idPhoto;
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
