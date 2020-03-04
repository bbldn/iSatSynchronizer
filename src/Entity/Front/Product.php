<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_product")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $product_id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $sku;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $upc;

    /**
     * @ORM\Column(type="string", length=14)
     */
    private $ean;

    /**
     * @ORM\Column(type="string", length=13)
     */
    private $jan;

    /**
     * @ORM\Column(type="string", length=17)
     */
    private $isbn;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $mpn;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $location;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock_status_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $manufacturer_id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $shipping = true;

    /**
     * @ORM\Column(type="float")
     */
    private $price = 0.0;

    /**
     * @ORM\Column(type="integer")
     */
    private $points = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $tax_class_id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_available;

    /**
     * @ORM\Column(type="float")
     */
    private $weight = 0.0;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight_class_id = 0;

    /**
     * @ORM\Column(type="float")
     */
    private $length = 0.0;

    /**
     * @ORM\Column(type="float")
     */
    private $width = 0.0;

    /**
     * @ORM\Column(type="float")
     */
    private $height = 0.0;

    /**
     * @ORM\Column(type="integer")
     */
    private $length_class_id = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $subtract = true;

    /**
     * @ORM\Column(type="boolean")
     */
    private $minimum = 1;

    /**
     * @ORM\Column(type="integer")
     */
    private $sort_order = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status = false;

    /**
     * @ORM\Column(type="integer")
     */
    private $viewed = 0;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_added;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_modified;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $oct_product_stickers;

    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    public function setProductId(int $product_id): self
    {
        $this->product_id = $product_id;

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
        return $this->stock_status_id;
    }

    public function setStockStatusId(int $stock_status_id): self
    {
        $this->stock_status_id = $stock_status_id;

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
        return $this->manufacturer_id;
    }

    public function setManufacturerId(int $manufacturer_id): self
    {
        $this->manufacturer_id = $manufacturer_id;

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
        return $this->tax_class_id;
    }

    public function setTaxClassId(int $tax_class_id): self
    {
        $this->tax_class_id = $tax_class_id;

        return $this;
    }

    public function getDateAvailable(): ?\DateTimeInterface
    {
        return $this->date_available;
    }

    public function setDateAvailable(\DateTimeInterface $date_available): self
    {
        $this->date_available = $date_available;

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
        return $this->weight_class_id;
    }

    public function setWeightClassId(int $weight_class_id): self
    {
        $this->weight_class_id = $weight_class_id;

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
        return $this->length_class_id;
    }

    public function setLengthClassId(int $length_class_id): self
    {
        $this->length_class_id = $length_class_id;

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
        return $this->sort_order;
    }

    public function setSortOrder(int $sort_order): self
    {
        $this->sort_order = $sort_order;

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
        return $this->date_added;
    }

    public function setDateAdded(\DateTimeInterface $date_added): self
    {
        $this->date_added = $date_added;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->date_modified;
    }

    public function setDateModified(\DateTimeInterface $date_modified): self
    {
        $this->date_modified = $date_modified;

        return $this;
    }

    public function getOctProductStickers(): ?string
    {
        return $this->oct_product_stickers;
    }

    public function setOctProductStickers(string $oct_product_stickers): self
    {
        $this->oct_product_stickers = $oct_product_stickers;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setDateModified(new \DateTime('now'));

        if ($this->getDateAdded() == null) {
            $this->setDateAdded(new \DateTime('now'));
        }
    }
}
