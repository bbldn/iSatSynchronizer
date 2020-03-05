<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_product_option_value")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductOptionValueRepository")
 */
class ProductOptionValue
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="`product_option_value_id`")
     */
    private $productOptionValueId;

    /**
     * @ORM\Column(type="integer", name="`product_option_id`")
     */
    private $productOptionId;

    /**
     * @ORM\Column(type="integer", name="`product_id`")
     */
    private $productId;

    /**
     * @ORM\Column(type="integer", name="`option_id`")
     */
    private $optionId;

    /**
     * @ORM\Column(type="integer", name="`option_value_id`")
     */
    private $optionValueId;

    /**
     * @ORM\Column(type="integer", name="`quantity`")
     */
    private $quantity;

    /**
     * @ORM\Column(type="boolean", name="`subtract`")
     */
    private $subtract;

    /**
     * @ORM\Column(type="float", name="`price`")
     */
    private $price;

    /**
     * @ORM\Column(type="string", name="`price_prefix`", length=1)
     */
    private $pricePrefix;

    /**
     * @ORM\Column(type="integer", name="`points`")
     */
    private $points;

    /**
     * @ORM\Column(type="string", name="`points_prefix`", length=1)
     */
    private $pointsPrefix;

    /**
     * @ORM\Column(type="float", name="`weight`")
     */
    private $weight;

    /**
     * @ORM\Column(type="string", name="`weight_prefix`", length=1)
     */
    private $weightPrefix;

    /**
     * @ORM\Column(type="string", name="`sku`")
     */
    private $sku;

    /**
     * @ORM\Column(type="string", name="`model`")
     */
    private $model;

    /**
     * @ORM\Column(type="string", name="`o_v_image`", length=255)
     */
    private $OVImage;

    public function getProductOptionValueId(): ?int
    {
        return $this->productOptionValueId;
    }

    public function setProductOptionValueId(int $productOptionValueId): self
    {
        $this->productOptionValueId = $productOptionValueId;

        return $this;
    }

    public function getProductOptionId(): ?int
    {
        return $this->productOptionId;
    }

    public function setProductOptionId(int $productOptionId): self
    {
        $this->productOptionId = $productOptionId;

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

    public function getOptionId(): ?int
    {
        return $this->optionId;
    }

    public function setOptionId(int $optionId): self
    {
        $this->optionId = $optionId;

        return $this;
    }

    public function getOptionValueId(): ?int
    {
        return $this->optionValueId;
    }

    public function setOptionValueId(int $optionValueId): self
    {
        $this->optionValueId = $optionValueId;

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

    public function getSubtract(): ?bool
    {
        return $this->subtract;
    }

    public function setSubtract(bool $subtract): self
    {
        $this->subtract = $subtract;

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

    public function getPricePrefix(): ?string
    {
        return $this->pricePrefix;
    }

    public function setPricePrefix(string $pricePrefix): self
    {
        $this->pricePrefix = $pricePrefix;

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

    public function getPointsPrefix(): ?string
    {
        return $this->pointsPrefix;
    }

    public function setPointsPrefix(string $pointsPrefix): self
    {
        $this->pointsPrefix = $pointsPrefix;

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

    public function getWeightPrefix(): ?string
    {
        return $this->weightPrefix;
    }

    public function setWeightPrefix(string $weightPrefix): self
    {
        $this->weightPrefix = $weightPrefix;

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

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getOVImage(): ?string
    {
        return $this->OVImage;
    }

    public function setOVImage(string $OVImage): self
    {
        $this->OVImage = $OVImage;

        return $this;
    }
}
