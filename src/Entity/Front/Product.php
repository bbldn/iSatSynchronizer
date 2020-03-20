<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $productId;

    /**
     * @ORM\Column(type="string", name="`model`", length=64)
     */
    private $model;

    /**
     * @ORM\Column(type="string", name="`sku`", length=64)
     */
    private $sku;

    /**
     * @ORM\Column(type="string", name="`upc`", length=12)
     */
    private $upc;

    /**
     * @ORM\Column(type="string", name="`ean`", length=14)
     */
    private $ean;

    /**
     * @ORM\Column(type="string", name="`jan`", length=13)
     */
    private $jan;

    /**
     * @ORM\Column(type="string", name="`isbn`", length=17)
     */
    private $isbn;

    /**
     * @ORM\Column(type="string", name="`mpn`", length=64)
     */
    private $mpn;

    /**
     * @ORM\Column(type="string", name="`location`", length=128)
     */
    private $location;

    /**
     * @ORM\Column(type="integer", name="`quantity`")
     */
    private $quantity = 0;

    /**
     * @ORM\Column(type="integer", name="`stock_status_id`")
     */
    private $stockStatusId;

    /**
     * @ORM\Column(type="string", name="`image`", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="integer", name="`manufacturer_id`")
     */
    private $manufacturerId;

    /**
     * @ORM\Column(type="boolean", name="`shipping`")
     */
    private $shipping = true;

    /**
     * @ORM\Column(type="float", name="`price`")
     */
    private $price = 0.0;

    /**
     * @ORM\Column(type="integer", name="`points`")
     */
    private $points = 0;

    /**
     * @ORM\Column(type="integer", name="`tax_class_id`")
     */
    private $taxClassId;

    /**
     * @ORM\Column(type="date", name="`date_available`")
     */
    private $dateAvailable;

    /**
     * @ORM\Column(type="float", name="`weight`")
     */
    private $weight = 0.0;

    /**
     * @ORM\Column(type="integer", name="`weight_class_id`")
     */
    private $weightClassId = 0;

    /**
     * @ORM\Column(type="float", name="`length`")
     */
    private $length = 0.0;

    /**
     * @ORM\Column(type="float", name="`width`")
     */
    private $width = 0.0;

    /**
     * @ORM\Column(type="float", name="`height`")
     */
    private $height = 0.0;

    /**
     * @ORM\Column(type="integer", name="`length_class_id`")
     */
    private $lengthClassId = 0;

    /**
     * @ORM\Column(type="boolean", name="`subtract`")
     */
    private $subtract = true;

    /**
     * @ORM\Column(type="boolean", name="`minimum`")
     */
    private $minimum = 1;

    /**
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    private $sortOrder = 0;

    /**
     * @ORM\Column(type="boolean", name="`status`")
     */
    private $status = false;

    /**
     * @ORM\Column(type="integer", name="`viewed`")
     */
    private $viewed = 0;

    /**
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    private $dateAdded;

    /**
     * @ORM\Column(type="datetime", name="`date_modified`")
     */
    private $dateModified;

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getUpc(): ?string
    {
        return $this->upc;
    }

    public function setUpc(string $upc): self
    {
        $this->upc = $upc;

        return $this;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(string $ean): self
    {
        $this->ean = $ean;

        return $this;
    }

    public function getJan(): ?string
    {
        return $this->jan;
    }

    public function setJan(string $jan): self
    {
        $this->jan = $jan;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getMpn(): ?string
    {
        return $this->mpn;
    }

    public function setMpn(string $mpn): self
    {
        $this->mpn = $mpn;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getStockStatusId(): ?int
    {
        return $this->stockStatusId;
    }

    public function setStockStatusId(int $stockStatusId): self
    {
        $this->stockStatusId = $stockStatusId;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getManufacturerId(): ?int
    {
        return $this->manufacturerId;
    }

    public function setManufacturerId(int $manufacturerId): self
    {
        $this->manufacturerId = $manufacturerId;

        return $this;
    }

    public function getShipping(): ?bool
    {
        return $this->shipping;
    }

    public function setShipping(bool $shipping): self
    {
        $this->shipping = $shipping;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getTaxClassId(): ?int
    {
        return $this->taxClassId;
    }

    public function setTaxClassId(int $taxClassId): self
    {
        $this->taxClassId = $taxClassId;

        return $this;
    }

    public function getDateAvailable(): ?\DateTimeInterface
    {
        return $this->dateAvailable;
    }

    public function setDateAvailable(\DateTimeInterface $dateAvailable): self
    {
        $this->dateAvailable = $dateAvailable;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeightClassId(): ?int
    {
        return $this->weightClassId;
    }

    public function setWeightClassId(int $weightClassId): self
    {
        $this->weightClassId = $weightClassId;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(float $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(float $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getLengthClassId(): ?int
    {
        return $this->lengthClassId;
    }

    public function setLengthClassId(int $lengthClassId): self
    {
        $this->lengthClassId = $lengthClassId;

        return $this;
    }

    public function getSubtract(): ?bool
    {
        return $this->subtract;
    }

    public function setSubtract(bool $subtract): self
    {
        $this->subtract = $subtract;

        return $this;
    }

    public function getMinimum(): ?bool
    {
        return $this->minimum;
    }

    public function setMinimum(bool $minimum): self
    {
        $this->minimum = $minimum;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getViewed(): ?int
    {
        return $this->viewed;
    }

    public function setViewed(int $viewed): self
    {
        $this->viewed = $viewed;

        return $this;
    }

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(\DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setDateModified(new \DateTime('now'));

        if (null === $this->getDateAdded()) {
            $this->setDateAdded(new \DateTime('now'));
        }
    }
}
