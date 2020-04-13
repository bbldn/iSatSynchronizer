<?php

namespace App\Entity\Front;

use App\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_option_value`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductOptionValueRepository")
 */
class ProductOptionValue extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="`product_option_value_id`")
     */
    private $id;

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
     * @param int $productOptionId
     * @param int $productId
     * @param int $optionId
     * @param int $optionValueId
     * @param int $quantity
     * @param bool $subtract
     * @param float $price
     * @param string $pricePrefix
     * @param int $points
     * @param string $pointsPrefix
     * @param float $weight
     * @param string $weightPrefix
     */
    public function fill(
        int $productOptionId,
        int $productId,
        int $optionId,
        int $optionValueId,
        int $quantity,
        bool $subtract,
        float $price,
        string $pricePrefix,
        int $points,
        string $pointsPrefix,
        float $weight,
        string $weightPrefix
    )
    {
        $this->productOptionId = $productOptionId;
        $this->productId = $productId;
        $this->optionId = $optionId;
        $this->optionValueId = $optionValueId;
        $this->quantity = $quantity;
        $this->subtract = $subtract;
        $this->price = $price;
        $this->pricePrefix = $pricePrefix;
        $this->points = $points;
        $this->pointsPrefix = $pointsPrefix;
        $this->weight = $weight;
        $this->weightPrefix = $weightPrefix;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

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
}
