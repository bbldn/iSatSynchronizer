<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="`oc_product_option`")
 * @ORM\Entity(repositoryClass="App\Repository\Front\ProductOptionRepository")
 */
class ProductOption
{
    /**
     * @ORM\Id()
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
     * @ORM\Column(type="string", name="`value`", length=255)
     */
    private $value;

    /**
     * @ORM\Column(type="boolean", name="`required`")
     */
    private $required;

    /**
     * @ORM\Column(type="integer")
     */
    private $product_option_id;

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
