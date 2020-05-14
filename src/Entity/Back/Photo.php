<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`photo`")
 * @ORM\Entity(repositoryClass="App\Repository\Back\PhotoRepository")
 */
class Photo
{
    /**
     * @var int|null $idPhoto
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`id_photo`")
     */
    protected $idPhoto;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=255)
     */
    protected $name;

    /**
     * @var int|null $productId
     * @ORM\Column(type="integer", name="`productID`")
     */
    protected $productId;

    /**
     * @var string|null $small
     * @ORM\Column(type="string", name="`small`")
     */
    protected $small;

    /**
     * @var string|null $big
     * @ORM\Column(type="string", name="`big`")
     */
    protected $big;

    /**
     * @var string|null $hide
     * @ORM\Column(type="string", name="`hide`")
     */
    protected $hide = 'hide';

    /**
     * @var int|null $pos
     * @ORM\Column(type="integer", name="`pos`")
     */
    protected $pos = 0;

    /**
     * @var int|null $idCatalog
     * @ORM\Column(type="integer", name="`id_catalog`")
     */
    protected $idCatalog = 0;

    /**
     * @return int|null
     */
    public function getIdPhoto(): ?int
    {
        return $this->idPhoto;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Photo
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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
     * @return Photo
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSmall(): ?string
    {
        return $this->small;
    }

    /**
     * @param string $small
     * @return Photo
     */
    public function setSmall(string $small): self
    {
        $this->small = $small;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBig(): ?string
    {
        return $this->big;
    }

    /**
     * @param string $big
     * @return Photo
     */
    public function setBig(string $big): self
    {
        $this->big = $big;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHide(): ?string
    {
        return $this->hide;
    }

    /**
     * @param string $hide
     * @return Photo
     */
    public function setHide(string $hide): self
    {
        $this->hide = $hide;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPos(): ?int
    {
        return $this->pos;
    }

    /**
     * @param int $pos
     * @return Photo
     */
    public function setPos(int $pos): self
    {
        $this->pos = $pos;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getIdCatalog(): ?int
    {
        return $this->idCatalog;
    }

    /**
     * @param int $idCatalog
     * @return Photo
     */
    public function setIdCatalog(int $idCatalog): self
    {
        $this->idCatalog = $idCatalog;

        return $this;
    }
}
