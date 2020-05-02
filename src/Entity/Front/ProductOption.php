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
    protected $productOptionId;

    /**
     * @ORM\Column(type="integer", name="`product_id`")
     */
    protected $productId;

    /**
     * @ORM\Column(type="integer", name="`option_id`")
     */
    protected $optionId;

    /**
     * @ORM\Column(type="string", name="`value`", length=255)
     */
    protected $value;

    /**
     * @ORM\Column(type="boolean", name="`required`")
     */
    protected $required;

    /**
     * @param int $productId
     * @param int $optionId
     * @param string $value
     * @param bool $required
     */
    public function fill(
        int $productId,
        int $optionId,
        string $value,
        bool $required
    )
    {
        $this->productId = $productId;
        $this->optionId = $optionId;
        $this->value = $value;
        $this->required = $required;
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
