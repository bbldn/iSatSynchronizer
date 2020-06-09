<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_manufacturer`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ManufacturerRepository")
 */
class Manufacturer
{
    /**
     * @var int|null $manufacturerId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`manufacturer_id`")
     */
    protected $manufacturerId;

    /**
     * @var string|null $name
     * @ORM\Column(type="string", name="`name`", length=64)
     */
    protected $name;

    /**
     * @var string|null $image
     * @ORM\Column(type="string", name="`image`", length=255, nullable=true)
     */
    protected $image;

    /**
     * @var int|null $sortOrder
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    protected $sortOrder;

    /**
     * @return int|null
     */
    public function getManufacturerId(): ?int
    {
        return $this->manufacturerId;
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
     * @return Manufacturer
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     * @return Manufacturer
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     * @return Manufacturer
     */
    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}
