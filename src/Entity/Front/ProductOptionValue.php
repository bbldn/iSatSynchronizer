<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_option_value`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductOptionValueRepository")
 */
class ProductOptionValue
{
    /**
     * @var int|null $productOptionValueId
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_option_value_id`")
     */
    protected $productOptionValueId;

    /**
     * @var int|null $productOptionId
     * @ORM\Column(type="integer", name="`product_option_id`")
     */
    protected $productOptionId;

    /**
     * @var int|null $productId
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @var int|null $optionId
     * @ORM\Column(type="integer", name="`option_id`")
     */
    protected $optionId;

    /**
     * @var int|null $optionValueId
     * @ORM\Column(type="integer", name="`option_value_id`")
     */
    protected $optionValueId;

    /**
     * @var int|null $quantity
     * @ORM\Column(type="integer", name="`quantity`")
     */
    protected $quantity;

    /**
     * @var bool|null $subtract
     * @ORM\Column(type="boolean", name="`subtract`")
     */
    protected $subtract;

    /**
     * @var float|null $price
     * @ORM\Column(type="float", name="`price`")
     */
    protected $price;

    /**
     * @var string|null $pricePrefix
     * @ORM\Column(type="string", name="`price_prefix`", length=1)
     */
    protected $pricePrefix;

    /**
     * @var int|null $points
     * @ORM\Column(type="integer", name="`points`")
     */
    protected $points;

    /**
     * @var string|null $pointsPrefix
     * @ORM\Column(type="string", name="`points_prefix`", length=1)
     */
    protected $pointsPrefix;

    /**
     * @var float|null $weight
     * @ORM\Column(type="float", name="`weight`")
     */
    protected $weight;

    /**
     * @var string|null $weightPrefix
     * @ORM\Column(type="string", name="`weight_prefix`", length=1)
     */
    protected $weightPrefix;

    /**
     * @return int|null
     */
    public function getProductOptionValueId(): ?int
    {
        return $this->productOptionValueId;
    }

    /**
     * @param int $productOptionValueId
     * @return ProductOptionValue
     */
    public function setProductOptionValueId(int $productOptionValueId): self
    {
        $this->productOptionValueId = $productOptionValueId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getProductOptionId(): ?int
    {
        return $this->productOptionId;
    }

    /**
     * @param int $productOptionId
     * @return ProductOptionValue
     */
    public function setProductOptionId(int $productOptionId): self
    {
        $this->productOptionId = $productOptionId;

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
     * @return ProductOptionValue
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOptionId(): ?int
    {
        return $this->optionId;
    }

    /**
     * @param int $optionId
     * @return ProductOptionValue
     */
    public function setOptionId(int $optionId): self
    {
        $this->optionId = $optionId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOptionValueId(): ?int
    {
        return $this->optionValueId;
    }

    /**
     * @param int $optionValueId
     * @return ProductOptionValue
     */
    public function setOptionValueId(int $optionValueId): self
    {
        $this->optionValueId = $optionValueId;

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
     * @return ProductOptionValue
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

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
     * @return ProductOptionValue
     */
    public function setSubtract(bool $subtract): self
    {
        $this->subtract = $subtract;

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
     * @return ProductOptionValue
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPricePrefix(): ?string
    {
        return $this->pricePrefix;
    }

    /**
     * @param string $pricePrefix
     * @return ProductOptionValue
     */
    public function setPricePrefix(string $pricePrefix): self
    {
        $this->pricePrefix = $pricePrefix;

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
     * @return ProductOptionValue
     */
    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPointsPrefix(): ?string
    {
        return $this->pointsPrefix;
    }

    /**
     * @param string $pointsPrefix
     * @return ProductOptionValue
     */
    public function setPointsPrefix(string $pointsPrefix): self
    {
        $this->pointsPrefix = $pointsPrefix;

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
     * @return ProductOptionValue
     */
    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWeightPrefix(): ?string
    {
        return $this->weightPrefix;
    }

    /**
     * @param string $weightPrefix
     * @return ProductOptionValue
     */
    public function setWeightPrefix(string $weightPrefix): self
    {
        $this->weightPrefix = $weightPrefix;

        return $this;
    }
}
