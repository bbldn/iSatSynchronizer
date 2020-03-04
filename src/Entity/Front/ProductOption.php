<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_product_option")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductOptionRepository")
 */
class ProductOption
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
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
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    /**
     * @ORM\Column(type="boolean")
     */
    private $required;

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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getRequired(): ?bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): self
    {
        $this->required = $required;

        return $this;
    }
}
