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
     * @ORM\Column(type="integer")
     */
    private $product_option_value_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $product_option_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $product_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $option_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $option_value_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="boolean")
     */
    private $subtract;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $price_prefix;

    /**
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $points_prefix;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $weight_prefix;

    /**
     * @ORM\Column(type="string")
     */
    private $sku;

    /**
     * @ORM\Column(type="string")
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $o_v_image;

    public function getProductOptionValueId(): ?int
    {
        return $this->product_option_value_id;
    }

    public function setProductOptionValueId(int $product_option_value_id): self
    {
        $this->product_option_value_id = $product_option_value_id;

        return $this;
    }

    public function getProductOptionId(): ?int
    {
        return $this->product_option_id;
    }

    public function setProductOptionId(int $product_option_id): self
    {
        $this->product_option_id = $product_option_id;

        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    public function setProductId(int $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getOptionId(): ?int
    {
        return $this->option_id;
    }

    public function setOptionId(int $option_id): self
    {
        $this->option_id = $option_id;

        return $this;
    }

    public function getOptionValueId(): ?int
    {
        return $this->option_value_id;
    }

    public function setOptionValueId(int $option_value_id): self
    {
        $this->option_value_id = $option_value_id;

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
        return $this->price_prefix;
    }

    public function setPricePrefix(string $price_prefix): self
    {
        $this->price_prefix = $price_prefix;

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
        return $this->points_prefix;
    }

    public function setPointsPrefix(string $points_prefix): self
    {
        $this->points_prefix = $points_prefix;

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
        return $this->weight_prefix;
    }

    public function setWeightPrefix(string $weight_prefix): self
    {
        $this->weight_prefix = $weight_prefix;

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
        return $this->o_v_image;
    }

    public function setOVImage(string $o_v_image): self
    {
        $this->o_v_image = $o_v_image;

        return $this;
    }
}
