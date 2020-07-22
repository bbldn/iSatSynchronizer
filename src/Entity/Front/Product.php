<?php

namespace App\Entity\Front;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Product
{
    /**
     * @var int|null $productId
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var string|null $model
     * @ORM\Column(type="string", name="`model`", length=64)
     */
    protected $model;

    /**
     * @var string|null $sku
     * @ORM\Column(type="string", name="`sku`", length=64)
     */
    protected $sku;

    /**
     * @var string|null $upc
     * @ORM\Column(type="string", name="`upc`", length=12)
     */
    protected $upc;

    /**
     * @var string|null $ean
     * @ORM\Column(type="string", name="`ean`", length=14)
     */
    protected $ean;

    /**
     * @var string|null $jan
     * @ORM\Column(type="string", name="`jan`", length=13)
     */
    protected $jan;

    /**
     * @var string|null $isbn
     * @ORM\Column(type="string", name="`isbn`", length=17)
     */
    protected $isbn;

    /**
     * @var string|null $mpn
     * @ORM\Column(type="string", name="`mpn`", length=64)
     */
    protected $mpn;

    /**
     * @var string|null $location
     * @ORM\Column(type="string", name="`location`", length=128)
     */
    protected $location;

    /**
     * @var int|null $quantity
     * @ORM\Column(type="integer", name="`quantity`")
     */
    protected $quantity = 0;

    /**
     * @var int|null $stockStatusId
     * @ORM\Column(type="integer", name="`stock_status_id`")
     */
    protected $stockStatusId;

    /**
     * @var string|null $image
     * @ORM\Column(type="string", name="`image`", length=255)
     */
    protected $image = null;

    /**
     * @var int|null $manufacturerId
     * @ORM\Column(type="integer", name="`manufacturer_id`")
     */
    protected $manufacturerId;

    /**
     * @var bool|null $shipping
     * @ORM\Column(type="boolean", name="`shipping`")
     */
    protected $shipping = true;

    /**
     * @var float|null $price
     * @ORM\Column(type="float", name="`price`")
     */
    protected $price = 0.0;

    /**
     * @var int|null $points
     * @ORM\Column(type="integer", name="`points`")
     */
    protected $points = 0;

    /**
     * @var int|null $taxClassId
     * @ORM\Column(type="integer", name="`tax_class_id`")
     */
    protected $taxClassId;

    /**
     * @var DateTimeInterface|null $dateAvailable
     * @ORM\Column(type="date", name="`date_available`")
     */
    protected $dateAvailable;

    /**
     * @var float|null $weight
     * @ORM\Column(type="float", name="`weight`")
     */
    protected $weight = 0.0;

    /**
     * @var int|null $weightClassId
     * @ORM\Column(type="integer", name="`weight_class_id`")
     */
    protected $weightClassId = 0;

    /**
     * @var float|null $length
     * @ORM\Column(type="float", name="`length`")
     */
    protected $length = 0.0;

    /**
     * @var float|null $width
     * @ORM\Column(type="float", name="`width`")
     */
    protected $width = 0.0;

    /**
     * @var float|null $height
     * @ORM\Column(type="float", name="`height`")
     */
    protected $height = 0.0;

    /**
     * @var int|null $lengthClassId
     * @ORM\Column(type="integer", name="`length_class_id`")
     */
    protected $lengthClassId = 0;

    /**
     * @var bool|null $subtract
     * @ORM\Column(type="boolean", name="`subtract`")
     */
    protected $subtract = true;

    /**
     * @var bool|null $minimum
     * @ORM\Column(type="boolean", name="`minimum`")
     */
    protected $minimum = true;

    /**
     * @var int|null $sortOrder
     * @ORM\Column(type="integer", name="`sort_order`")
     */
    protected $sortOrder = 0;

    /**
     * @var bool|null $status
     * @ORM\Column(type="boolean", name="`status`")
     */
    protected $status = false;

    /**
     * @var int|null $viewed
     * @ORM\Column(type="integer", name="`viewed`")
     */
    protected $viewed = 0;

    /**
     * @var DateTimeInterface|null $dateAdded
     * @ORM\Column(type="datetime", name="`date_added`")
     */
    protected $dateAdded;

    /**
     * @var DateTimeInterface|null $dateModified
     * @ORM\Column(type="datetime", name="`date_modified`")
     */
    protected $dateModified;

    /**
     * Product constructor.
     * @param int|null $productId
     * @param null|string $model
     * @param null|string $sku
     * @param null|string $upc
     * @param null|string $ean
     * @param null|string $jan
     * @param null|string $isbn
     * @param null|string $mpn
     * @param null|string $location
     * @param int|null $quantity
     * @param int|null $stockStatusId
     * @param null|string $image
     * @param int|null $manufacturerId
     * @param bool|null $shipping
     * @param float|null $price
     * @param int|null $points
     * @param int|null $taxClassId
     * @param DateTimeInterface|null $dateAvailable
     * @param float|null $weight
     * @param int|null $weightClassId
     * @param float|null $length
     * @param float|null $width
     * @param float|null $height
     * @param int|null $lengthClassId
     * @param bool|null $subtract
     * @param bool|null $minimum
     * @param int|null $sortOrder
     * @param bool|null $status
     * @param int|null $viewed
     * @param DateTimeInterface|null $dateAdded
     * @param DateTimeInterface|null $dateModified
     */
    public function __construct(
        ?int $productId,
        ?string $model,
        ?string $sku,
        ?string $upc,
        ?string $ean,
        ?string $jan,
        ?string $isbn,
        ?string $mpn,
        ?string $location,
        ?int $quantity,
        ?int $stockStatusId,
        ?string $image,
        ?int $manufacturerId,
        ?bool $shipping,
        ?float $price,
        ?int $points,
        ?int $taxClassId,
        ?DateTimeInterface $dateAvailable,
        ?float $weight,
        ?int $weightClassId,
        ?float $length,
        ?float $width,
        ?float $height,
        ?int $lengthClassId,
        ?bool $subtract,
        ?bool $minimum,
        ?int $sortOrder,
        ?bool $status,
        ?int $viewed,
        ?DateTimeInterface $dateAdded,
        ?DateTimeInterface $dateModified
    )
    {
        $this->productId = $productId;
        $this->model = $model;
        $this->sku = $sku;
        $this->upc = $upc;
        $this->ean = $ean;
        $this->jan = $jan;
        $this->isbn = $isbn;
        $this->mpn = $mpn;
        $this->location = $location;
        $this->quantity = $quantity;
        $this->stockStatusId = $stockStatusId;
        $this->image = $image;
        $this->manufacturerId = $manufacturerId;
        $this->shipping = $shipping;
        $this->price = $price;
        $this->points = $points;
        $this->taxClassId = $taxClassId;
        $this->dateAvailable = $dateAvailable;
        $this->weight = $weight;
        $this->weightClassId = $weightClassId;
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->lengthClassId = $lengthClassId;
        $this->subtract = $subtract;
        $this->minimum = $minimum;
        $this->sortOrder = $sortOrder;
        $this->status = $status;
        $this->viewed = $viewed;
        $this->dateAdded = $dateAdded;
        $this->dateModified = $dateModified;
    }


    /**
     * @param int|null $productId
     * @return Product
     */
    public function setProductId(?int $productId): self
    {
        $this->productId = $productId;

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
     * @return string|null
     */
    public function getModel(): ?string
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return Product
     */
    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return Product
     */
    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpc(): ?string
    {
        return $this->upc;
    }

    /**
     * @param string $upc
     * @return Product
     */
    public function setUpc(string $upc): self
    {
        $this->upc = $upc;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEan(): ?string
    {
        return $this->ean;
    }

    /**
     * @param string $ean
     * @return Product
     */
    public function setEan(string $ean): self
    {
        $this->ean = $ean;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getJan(): ?string
    {
        return $this->jan;
    }

    /**
     * @param string $jan
     * @return Product
     */
    public function setJan(string $jan): self
    {
        $this->jan = $jan;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     * @return Product
     */
    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMpn(): ?string
    {
        return $this->mpn;
    }

    /**
     * @param string $mpn
     * @return Product
     */
    public function setMpn(string $mpn): self
    {
        $this->mpn = $mpn;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return Product
     */
    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return Product
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStockStatusId(): ?int
    {
        return $this->stockStatusId;
    }

    /**
     * @param int $stockStatusId
     * @return Product
     */
    public function setStockStatusId(int $stockStatusId): self
    {
        $this->stockStatusId = $stockStatusId;

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
     * @return Product
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getManufacturerId(): ?int
    {
        return $this->manufacturerId;
    }

    /**
     * @param int $manufacturerId
     * @return Product
     */
    public function setManufacturerId(int $manufacturerId): self
    {
        $this->manufacturerId = $manufacturerId;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getShipping(): ?bool
    {
        return $this->shipping;
    }

    /**
     * @param bool $shipping
     * @return Product
     */
    public function setShipping(bool $shipping): self
    {
        $this->shipping = $shipping;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Product
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPoints(): ?int
    {
        return $this->points;
    }

    /**
     * @param int $points
     * @return Product
     */
    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTaxClassId(): ?int
    {
        return $this->taxClassId;
    }

    /**
     * @param int $taxClassId
     * @return Product
     */
    public function setTaxClassId(int $taxClassId): self
    {
        $this->taxClassId = $taxClassId;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateAvailable(): ?DateTimeInterface
    {
        return $this->dateAvailable;
    }

    /**
     * @param DateTimeInterface $dateAvailable
     * @return Product
     */
    public function setDateAvailable(DateTimeInterface $dateAvailable): self
    {
        $this->dateAvailable = $dateAvailable;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     * @return Product
     */
    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getWeightClassId(): ?int
    {
        return $this->weightClassId;
    }

    /**
     * @param int $weightClassId
     * @return Product
     */
    public function setWeightClassId(int $weightClassId): self
    {
        $this->weightClassId = $weightClassId;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLength(): ?float
    {
        return $this->length;
    }

    /**
     * @param float $length
     * @return Product
     */
    public function setLength(float $length): self
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getWidth(): ?float
    {
        return $this->width;
    }

    /**
     * @param float $width
     * @return Product
     */
    public function setWidth(float $width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getHeight(): ?float
    {
        return $this->height;
    }

    /**
     * @param float $height
     * @return Product
     */
    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLengthClassId(): ?int
    {
        return $this->lengthClassId;
    }

    /**
     * @param int $lengthClassId
     * @return Product
     */
    public function setLengthClassId(int $lengthClassId): self
    {
        $this->lengthClassId = $lengthClassId;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSubtract(): ?bool
    {
        return $this->subtract;
    }

    /**
     * @param bool $subtract
     * @return Product
     */
    public function setSubtract(bool $subtract): self
    {
        $this->subtract = $subtract;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getMinimum(): ?bool
    {
        return $this->minimum;
    }

    /**
     * @param bool $minimum
     * @return Product
     */
    public function setMinimum(bool $minimum): self
    {
        $this->minimum = $minimum;

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
     * @return Product
     */
    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return Product
     */
    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getViewed(): ?int
    {
        return $this->viewed;
    }

    /**
     * @param int $viewed
     * @return Product
     */
    public function setViewed(int $viewed): self
    {
        $this->viewed = $viewed;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateModified(): ?DateTimeInterface
    {
        return $this->dateModified;
    }

    /**
     * @param DateTimeInterface $dateModified
     * @return Product
     */
    public function setDateModified(DateTimeInterface $dateModified): self
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
        $this->setDateModified(new DateTime('now'));

        if (null === $this->getDateAdded()) {
            $this->setDateAdded(new DateTime('now'));
        }
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateAdded(): ?DateTimeInterface
    {
        return $this->dateAdded;
    }

    /**
     * @param DateTimeInterface $dateAdded
     * @return Product
     */
    public function setDateAdded(DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}
